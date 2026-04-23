<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Services\MatchingEngine;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminParticipantController extends Controller
{
    public function index(Request $request): View
    {
        $query = Participant::with(['company.industry', 'company.prefecture'])
            ->orderByDesc('created_at');

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('company', fn($cq) => $cq->where('company_name', 'like', "%{$search}%"));
            });
        }

        if ($status = $request->query('status')) {
            $query->where('registration_status', $status);
        }

        $participants = $query->paginate(30)->withQueryString();

        return view('admin.participants.index', compact('participants'));
    }

    public function show(Participant $participant): View
    {
        $participant->load([
            'company.industry',
            'company.prefecture',
            'profile',
            'issues',
            'partnerTypes',
            'purposes',
            'matchingCandidates.candidate.company',
            'sentContactRequests.toParticipant',
        ]);

        return view('admin.participants.show', compact('participant'));
    }

    public function recalculate(Participant $participant, MatchingEngine $engine)
    {
        $engine->recalculateFor($participant->id);
        return back()->with('success', 'マッチングを再計算しました。');
    }
}
