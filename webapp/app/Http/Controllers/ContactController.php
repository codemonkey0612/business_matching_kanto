<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactNotificationJob;
use App\Models\ContactRequest;
use App\Models\NotificationLog;
use App\Models\Participant;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $participant = $request->attributes->get('participant');

        if (!$participant->isCompleted()) {
            return redirect()->route('profile.edit')->with('info', 'プロフィールを完成させてから連絡希望を送ってください。');
        }

        $data = $request->validate([
            'to_participant_id' => ['required', 'integer', 'exists:participants,id'],
        ]);

        $toId = (int) $data['to_participant_id'];

        if ($toId === $participant->id) {
            return back()->withErrors(['to_participant_id' => '自分自身には送れません']);
        }

        $target = Participant::where('id', $toId)
            ->where('registration_status', 'completed')
            ->first();
        if (!$target) {
            return back()->withErrors(['to_participant_id' => '送信先の参加者が見つかりません']);
        }

        $existing = ContactRequest::where('from_participant_id', $participant->id)
            ->where('to_participant_id', $toId)
            ->first();

        $contactRequest = ContactRequest::create([
            'from_participant_id'   => $participant->id,
            'to_participant_id'     => $toId,
            'is_resend'             => (bool) $existing,
            'created_at'            => now(),
        ]);

        $subject = '【ビジネスマッチング】連絡希望のお知らせ';
        foreach ([$participant, $target] as $recipient) {
            $log = NotificationLog::create([
                'contact_request_id'    => $contactRequest->id,
                'target_participant_id' => $recipient->id,
                'target_email'          => $recipient->email,
                'mail_subject'          => $subject,
                'send_status'           => 'pending',
                'retry_count'           => 0,
                'created_at'            => now(),
            ]);
            SendContactNotificationJob::dispatch($log->id);
        }

        return redirect()->route('contact.sent');
    }

    public function sent()
    {
        return view('matching.sent');
    }
}
