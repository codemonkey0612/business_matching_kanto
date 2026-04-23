<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\MatchingViewLog;
use App\Models\NotificationLog;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $stats = [
            'total'             => Participant::count(),
            'completed'         => Participant::where('registration_status', 'completed')->count(),
            'draft'             => Participant::where('registration_status', 'draft')->count(),
            'contacts'          => ContactRequest::count(),
            'display_count'     => MatchingViewLog::count(),
            'mail_total'        => NotificationLog::count(),
            'mail_sent'         => NotificationLog::where('send_status', 'sent')->count(),
            'mail_failed'       => NotificationLog::where('send_status', 'failed')->count(),
        ];

        $recentContacts = ContactRequest::with(['fromParticipant', 'toParticipant'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentContacts'));
    }
}
