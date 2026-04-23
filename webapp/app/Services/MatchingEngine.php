<?php

namespace App\Services;

use App\Models\MatchingCandidate;
use App\Models\Participant;
use App\Models\PrefectureMaster;
use Illuminate\Support\Facades\DB;

/**
 * Condition-based matching engine per spec §6 of マッチング条件仕様.
 *
 * Priority (spec §5):
 *  1) 希望目的の相性
 *  2) 求めている相手(選択)と相手カテゴリ(業種/partnerTypes)の整合
 *  3) 現在の課題(選択)と相手カテゴリの整合 (via affinity map)
 *  4) 業種の近さまたは補完関係
 *  5) 都道府県の近さ
 *  6) 事業内容やその他自由入力の補助一致
 *
 * 10件まで表示, 不足時は条件を段階的に緩和 (spec §8, §9).
 */
class MatchingEngine
{
    private const MAX_CANDIDATES = 10;

    private const W_PURPOSE = 30;
    private const W_PARTNER_MATCH = 25;
    private const W_ISSUE_AFFINITY = 20;
    private const W_INDUSTRY = 10;
    private const W_PREFECTURE = 10;
    private const W_FREE_TEXT = 5;

    private const PURPOSE_AFFINITY = [
        '仕事を依頼したい'  => ['仕事を受けたい' => 30],
        '仕事を受けたい'    => ['仕事を依頼したい' => 30],
        '協業したい'        => ['協業したい' => 30, '課題相談したい' => 15],
        '課題相談したい'    => ['協業したい' => 15, '仕事を受けたい' => 15],
    ];

    public function recalculateFor(int $participantId): int
    {
        $self = Participant::with(['company', 'profile', 'issues', 'partnerTypes', 'purposes'])
            ->find($participantId);

        if (!$self || !$self->isCompleted()) {
            MatchingCandidate::where('participant_id', $participantId)->delete();
            return 0;
        }

        $others = Participant::with(['company', 'profile', 'issues', 'partnerTypes', 'purposes'])
            ->where('id', '!=', $participantId)
            ->where('registration_status', 'completed')
            ->get();

        $affinityMap = $this->buildAffinityMap();
        $sameArea = $this->sameAreaPrefectures($self->company?->prefecture_master_id);

        $scored = [];
        foreach ($others as $other) {
            $score = $this->scoreStrict($self, $other, $affinityMap, $sameArea);
            if ($score > 0) {
                $scored[] = ['participant' => $other, 'score' => $score, 'relaxed' => 0];
            }
        }

        if (count($scored) < self::MAX_CANDIDATES) {
            $excluded = array_fill_keys(array_map(fn($r) => $r['participant']->id, $scored), true);
            foreach ($others as $other) {
                if (isset($excluded[$other->id])) continue;
                $score = $this->scoreRelaxed($self, $other, $affinityMap);
                if ($score > 0) {
                    $scored[] = ['participant' => $other, 'score' => $score, 'relaxed' => 1];
                }
            }
        }

        usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);
        $top = array_slice($scored, 0, self::MAX_CANDIDATES);

        DB::transaction(function () use ($participantId, $top) {
            MatchingCandidate::where('participant_id', $participantId)->delete();
            $now = now();
            foreach ($top as $i => $row) {
                $label = $row['score'] >= 50 ? '相性が高い' : ($row['score'] >= 25 ? '相談向き' : '候補');
                MatchingCandidate::create([
                    'participant_id' => $participantId,
                    'candidate_participant_id' => $row['participant']->id,
                    'rank_no' => $i + 1,
                    'match_label' => $label,
                    'score_total' => $row['score'],
                    'calculated_at' => $now,
                ]);
            }
        });

        return count($top);
    }

    public function recalculateAll(): void
    {
        Participant::where('registration_status', 'completed')
            ->pluck('id')
            ->each(fn($id) => $this->recalculateFor((int) $id));
    }

    private function scoreStrict(Participant $self, Participant $other, array $affinityMap, array $sameArea): int
    {
        $score = 0;
        $score += $this->purposeScore($self, $other);
        $score += $this->partnerMatchScore($self, $other);
        $score += $this->issueAffinityScore($self, $other, $affinityMap);
        $score += $this->industryScore($self, $other);

        if ($self->company?->prefecture_master_id && $other->company?->prefecture_master_id) {
            if ($self->company->prefecture_master_id === $other->company->prefecture_master_id) {
                $score += self::W_PREFECTURE;
            } elseif (in_array($other->company->prefecture_master_id, $sameArea, true)) {
                $score += (int) (self::W_PREFECTURE / 2);
            }
        }

        $score += $this->freeTextScore($self, $other);

        return $score;
    }

    private function scoreRelaxed(Participant $self, Participant $other, array $affinityMap): int
    {
        $score = 0;
        $score += $this->purposeScore($self, $other);
        $score += (int) ($this->partnerMatchScore($self, $other) * 0.7);
        $score += (int) ($this->issueAffinityScore($self, $other, $affinityMap) * 0.7);
        $score += $this->freeTextScore($self, $other) * 2;
        return $score;
    }

    private function purposeScore(Participant $self, Participant $other): int
    {
        $selfNames = $self->purposes->pluck('name')->all();
        $otherNames = $other->purposes->pluck('name')->all();
        $best = 0;
        foreach ($selfNames as $s) {
            foreach ($otherNames as $o) {
                $v = self::PURPOSE_AFFINITY[$s][$o] ?? 0;
                if ($v > $best) $best = $v;
            }
        }
        return $best;
    }

    private function partnerMatchScore(Participant $self, Participant $other): int
    {
        $wantedByMe = $self->partnerTypes->pluck('name')->map(fn($n) => (string) $n)->all();
        $otherIndustry = (string) ($other->company?->industry?->name ?? '');
        $otherPartnerNames = $other->partnerTypes->pluck('name')->map(fn($n) => (string) $n)->all();

        $overlap = array_intersect($wantedByMe, $otherPartnerNames);
        $score = count($overlap) * self::W_PARTNER_MATCH;

        foreach ($wantedByMe as $w) {
            if ($otherIndustry !== '' && (str_contains($w, $otherIndustry) || str_contains($otherIndustry, $w))) {
                $score += (int) (self::W_PARTNER_MATCH / 2);
                break;
            }
        }

        return min($score, self::W_PARTNER_MATCH * 3);
    }

    private function issueAffinityScore(Participant $self, Participant $other, array $affinityMap): int
    {
        $selfIssueIds = $self->issues->pluck('id')->all();
        $otherPartnerNames = $other->partnerTypes->pluck('name')->all();
        $otherIndustry = (string) ($other->company?->industry?->name ?? '');

        $score = 0;
        foreach ($selfIssueIds as $issueId) {
            $candidates = $affinityMap[$issueId] ?? [];
            foreach ($candidates as $partnerName) {
                if (in_array($partnerName, $otherPartnerNames, true)) {
                    $score += self::W_ISSUE_AFFINITY;
                    break;
                }
                if ($otherIndustry !== '' && (str_contains($partnerName, $otherIndustry) || str_contains($otherIndustry, $partnerName))) {
                    $score += (int) (self::W_ISSUE_AFFINITY / 2);
                    break;
                }
            }
        }
        return min($score, self::W_ISSUE_AFFINITY * 3);
    }

    private function industryScore(Participant $self, Participant $other): int
    {
        $a = $self->company?->industry_master_id;
        $b = $other->company?->industry_master_id;
        if ($a && $b && $a === $b) {
            return self::W_INDUSTRY;
        }
        return 0;
    }

    private function freeTextScore(Participant $self, Participant $other): int
    {
        $wantBits = collect([
            $self->profile?->business_summary_1,
            $self->profile?->business_summary_2,
            $self->profile?->issue_other_text,
            $self->profile?->partner_other_text,
        ])->filter()->implode(' ');

        $otherBits = collect([
            $other->profile?->business_summary_1,
            $other->profile?->business_summary_2,
        ])->filter()->implode(' ');

        if ($wantBits === '' || $otherBits === '') return 0;

        $tokens = array_unique(preg_split('/[\s、。,.\/]+/u', $wantBits) ?: []);
        $hit = 0;
        foreach ($tokens as $t) {
            if (mb_strlen($t) < 2) continue;
            if (mb_stripos($otherBits, $t) !== false) $hit++;
            if ($hit >= 3) break;
        }
        return $hit > 0 ? self::W_FREE_TEXT : 0;
    }

    private function buildAffinityMap(): array
    {
        $map = [];
        $affinities = DB::table('issue_partner_affinities as a')
            ->join('partner_type_masters as p', 'a.partner_type_master_id', '=', 'p.id')
            ->select('a.issue_master_id', 'p.name')
            ->get();

        foreach ($affinities as $row) {
            $map[$row->issue_master_id][] = $row->name;
        }
        return $map;
    }

    private function sameAreaPrefectures(?int $prefectureId): array
    {
        if (!$prefectureId) return [];
        $me = PrefectureMaster::find($prefectureId);
        if (!$me) return [];
        return PrefectureMaster::where('area_group', $me->area_group)
            ->where('id', '!=', $prefectureId)
            ->pluck('id')
            ->all();
    }
}
