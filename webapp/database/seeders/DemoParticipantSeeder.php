<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\MatchingEngine;

class DemoParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $industries = DB::table('industry_masters')->pluck('id', 'name');
        $prefectures = DB::table('prefecture_masters')->pluck('id', 'name');
        $issues = DB::table('issue_masters')->pluck('id', 'name');
        $partners = DB::table('partner_type_masters')->pluck('id', 'name');
        $purposes = DB::table('purpose_masters')->pluck('id', 'name');

        $demo = [
            [
                'company_name' => '株式会社サンプル',
                'industry' => 'IT・Web',
                'prefecture' => '東京都',
                'address' => '東京都渋谷区○○1-2-3',
                'name' => '山田 太郎',
                'kana' => 'やまだ たろう',
                'role' => '代表取締役',
                'phone' => '090-1234-5678',
                'email' => 'demo1@example.co.jp',
                'biz1' => '中小企業向けのWeb制作と業務改善支援を行っています。',
                'biz2' => '東京を中心に年間30社ほどの支援実績があります。',
                'issues' => ['営業先を増やしたい', '紹介先を増やしたい'],
                'partners' => ['営業支援会社', '動画制作会社', '採用支援会社'],
                'purposes' => ['仕事を依頼したい', '協業したい'],
            ],
            [
                'company_name' => '株式会社リンクパートナー',
                'industry' => 'コンサルティング',
                'prefecture' => '東京都',
                'address' => '東京都港区△△5-6-7',
                'name' => '佐藤 花子',
                'kana' => 'さとう はなこ',
                'role' => '取締役',
                'phone' => '090-2345-6789',
                'email' => 'demo2@example.co.jp',
                'biz1' => '営業代行・商談設定・営業体制づくりを支援しています。',
                'biz2' => 'IT/Web業界向けの実績多数。',
                'issues' => ['協業先を見つけたい', '継続受注を増やしたい'],
                'partners' => ['Web制作会社', '採用支援会社'],
                'purposes' => ['仕事を受けたい', '協業したい'],
            ],
            [
                'company_name' => '合同会社ムーバーグロース',
                'industry' => 'デザイン・クリエイティブ',
                'prefecture' => '神奈川県',
                'address' => '神奈川県横浜市□□2-3-4',
                'name' => '鈴木 一郎',
                'kana' => 'すずき いちろう',
                'role' => '代表',
                'phone' => '090-3456-7890',
                'email' => 'demo3@example.co.jp',
                'biz1' => '企業紹介動画・採用動画・SNS動画を制作しています。',
                'biz2' => '年間100本以上の動画制作実績。',
                'issues' => ['継続案件を増やしたい'],
                'partners' => ['営業支援会社', 'Web制作会社'],
                'purposes' => ['仕事を受けたい', '協業したい'],
            ],
            [
                'company_name' => '株式会社人材ブリッジ',
                'industry' => '人材・HR',
                'prefecture' => '埼玉県',
                'address' => '埼玉県さいたま市◇◇3-4-5',
                'name' => '高橋 恵',
                'kana' => 'たかはし めぐみ',
                'role' => '代表取締役',
                'phone' => '090-4567-8901',
                'email' => 'demo4@example.co.jp',
                'biz1' => '中小企業向けの採用広報支援・母集団形成を行っています。',
                'biz2' => '採用ピッチ資料作成から採用動線設計まで一貫対応。',
                'issues' => ['社外企業との接点を増やしたい'],
                'partners' => ['Web制作会社', '経営者同士の相談相手'],
                'purposes' => ['仕事を受けたい', '課題相談したい'],
            ],
            [
                'company_name' => '株式会社AIベースソリューション',
                'industry' => 'ソフトウェア・SaaS',
                'prefecture' => '東京都',
                'address' => '東京都千代田区××6-7-8',
                'name' => '中村 啓介',
                'kana' => 'なかむら けいすけ',
                'role' => 'CTO',
                'phone' => '090-5678-9012',
                'email' => 'demo5@example.co.jp',
                'biz1' => 'AI導入支援・業務自動化・データ分析基盤構築を提供。',
                'biz2' => '中小企業向けのパッケージ型AI導入が強み。',
                'issues' => ['新規顧客を増やしたい', 'AI活用を進めたい'],
                'partners' => ['営業支援会社', 'マーケティング支援会社'],
                'purposes' => ['仕事を受けたい', '協業したい'],
            ],
            [
                'company_name' => '株式会社マルチコマース',
                'industry' => '卸売・小売',
                'prefecture' => '大阪府',
                'address' => '大阪府大阪市●●7-8-9',
                'name' => '田中 美咲',
                'kana' => 'たなか みさき',
                'role' => '代表取締役',
                'phone' => '090-6789-0123',
                'email' => 'demo6@example.co.jp',
                'biz1' => 'オンラインショップ運営と自社ブランド販売。',
                'biz2' => '年間売上3億円、成長フェーズ。',
                'issues' => ['ECを強化したい', '集客を強化したい', '広告運用を見直したい'],
                'partners' => ['EC支援会社', '広告運用会社', 'Web制作会社'],
                'purposes' => ['仕事を依頼したい', '課題相談したい'],
            ],
        ];

        foreach ($demo as $d) {
            $companyId = DB::table('companies')->insertGetId([
                'company_name' => $d['company_name'],
                'industry_master_id' => $industries[$d['industry']] ?? $industries->first(),
                'address_text' => $d['address'],
                'prefecture_master_id' => $prefectures[$d['prefecture']] ?? $prefectures->first(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $participantId = DB::table('participants')->insertGetId([
                'company_id' => $companyId,
                'name' => $d['name'],
                'name_kana' => $d['kana'],
                'role_title' => $d['role'],
                'phone_number' => $d['phone'],
                'email' => $d['email'],
                'password_hash' => Hash::make('password'),
                'registration_status' => 'completed',
                'agreed_at' => true,
                'agreed_timestamp' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('participant_profiles')->insert([
                'participant_id' => $participantId,
                'business_summary_1' => $d['biz1'],
                'business_summary_2' => $d['biz2'],
                'issue_other_text' => null,
                'partner_other_text' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($d['issues'] as $name) {
                if (!isset($issues[$name])) continue;
                DB::table('participant_issues')->insertOrIgnore([
                    'participant_id' => $participantId,
                    'issue_master_id' => $issues[$name],
                    'created_at' => $now,
                ]);
            }
            foreach ($d['partners'] as $name) {
                if (!isset($partners[$name])) continue;
                DB::table('participant_partner_types')->insertOrIgnore([
                    'participant_id' => $participantId,
                    'partner_type_master_id' => $partners[$name],
                    'created_at' => $now,
                ]);
            }
            foreach ($d['purposes'] as $name) {
                if (!isset($purposes[$name])) continue;
                DB::table('participant_purposes')->insertOrIgnore([
                    'participant_id' => $participantId,
                    'purpose_master_id' => $purposes[$name],
                    'created_at' => $now,
                ]);
            }
        }

        $engine = app(MatchingEngine::class);
        foreach (DB::table('participants')->pluck('id') as $pid) {
            $engine->recalculateFor((int) $pid);
        }
    }
}
