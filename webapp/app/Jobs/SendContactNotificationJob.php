<?php

namespace App\Jobs;

use App\Mail\ContactNotificationMail;
use App\Models\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(private readonly int $notificationLogId) {}

    public function handle(): void
    {
        $log = NotificationLog::with(['contactRequest.fromParticipant', 'contactRequest.toParticipant', 'target'])
            ->findOrFail($this->notificationLogId);

        if ($log->send_status === 'sent') {
            return;
        }

        try {
            Mail::to($log->target_email)
                ->send(new ContactNotificationMail($log->contactRequest, $log->target));

            $log->update([
                'send_status'   => 'sent',
                'sent_at'       => now(),
                'retry_count'   => $this->attempts() - 1,
            ]);
        } catch (\Throwable $e) {
            $log->update([
                'retry_count'   => $this->attempts(),
                'send_status'   => $this->attempts() >= $this->tries ? 'failed' : 'pending',
            ]);
            throw $e;
        }
    }

    public function failed(\Throwable $e): void
    {
        NotificationLog::where('id', $this->notificationLogId)
            ->update(['send_status' => 'failed', 'retry_count' => $this->tries]);
    }
}
