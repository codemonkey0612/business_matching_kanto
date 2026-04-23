<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Participant extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'name_kana',
        'role_title',
        'phone_number',
        'email',
        'password_hash',
        'registration_status',
        'agreed_at',
        'agreed_timestamp',
        'remember_token',
    ];

    protected $hidden = ['password_hash', 'remember_token'];

    protected $casts = [
        'agreed_at' => 'boolean',
        'agreed_timestamp' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(ParticipantProfile::class);
    }

    public function issues(): BelongsToMany
    {
        return $this->belongsToMany(
            IssueMaster::class,
            'participant_issues',
            'participant_id',
            'issue_master_id'
        );
    }

    public function partnerTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            PartnerTypeMaster::class,
            'participant_partner_types',
            'participant_id',
            'partner_type_master_id'
        );
    }

    public function purposes(): BelongsToMany
    {
        return $this->belongsToMany(
            PurposeMaster::class,
            'participant_purposes',
            'participant_id',
            'purpose_master_id'
        );
    }

    public function matchingCandidates(): HasMany
    {
        return $this->hasMany(MatchingCandidate::class, 'participant_id')
            ->orderBy('rank_no');
    }

    public function sentContactRequests(): HasMany
    {
        return $this->hasMany(ContactRequest::class, 'from_participant_id');
    }

    public function receivedContactRequests(): HasMany
    {
        return $this->hasMany(ContactRequest::class, 'to_participant_id');
    }

    public function isCompleted(): bool
    {
        return $this->registration_status === 'completed';
    }
}
