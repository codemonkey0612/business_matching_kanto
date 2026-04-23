<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchingCandidate extends Model
{
    protected $fillable = [
        'participant_id',
        'candidate_participant_id',
        'rank_no',
        'match_label',
        'score_total',
        'calculated_at',
    ];

    protected $casts = [
        'calculated_at' => 'datetime',
    ];

    public $timestamps = false;

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'candidate_participant_id');
    }
}
