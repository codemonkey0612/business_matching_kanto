<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\MatchingViewLog;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    public function index(Request $request)
    {
        $participant = $request->attributes->get('participant');

        if (!$participant->isCompleted()) {
            return redirect()->route('profile.edit')->with('info', 'プロフィールを完成させてください。');
        }

        $candidates = $participant->matchingCandidates()
            ->with(['candidate.company.industry', 'candidate.company.prefecture', 'candidate.profile', 'candidate.issues', 'candidate.partnerTypes', 'candidate.purposes'])
            ->get();

        MatchingViewLog::create([
            'participant_id'    => $participant->id,
            'candidate_count'   => $candidates->count(),
        ]);

        $sentToIds = ContactRequest::where('from_participant_id', $participant->id)
            ->pluck('to_participant_id')
            ->mapWithKeys(fn($id) => [$id => true])
            ->all();

        return view('matching.index', compact('participant', 'candidates', 'sentToIds'));
    }
}
