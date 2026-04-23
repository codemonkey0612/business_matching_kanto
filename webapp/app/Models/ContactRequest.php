<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactRequest extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'from_participant_id',
        'to_participant_id',
        'is_resend',
        'created_at',
    ];

    protected $casts = [
        'is_resend' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function fromParticipant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'from_participant_id');
    }

    public function toParticipant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'to_participant_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationLog::class);
    }
}
