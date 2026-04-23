<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipantProfile extends Model
{
    protected $fillable = [
        'participant_id',
        'business_summary_1',
        'business_summary_2',
        'issue_other_text',
        'partner_other_text',
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
