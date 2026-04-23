<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'contact_request_id',
        'target_participant_id',
        'target_email',
        'mail_subject',
        'send_status',
        'retry_count',
        'sent_at',
        'created_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function contactRequest(): BelongsTo
    {
        return $this->belongsTo(ContactRequest::class);
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'target_participant_id');
    }
}
