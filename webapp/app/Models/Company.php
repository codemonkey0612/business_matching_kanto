<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'industry_master_id',
        'address_text',
        'prefecture_master_id',
    ];

    public function industry(): BelongsTo
    {
        return $this->belongsTo(IndustryMaster::class, 'industry_master_id');
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(PrefectureMaster::class, 'prefecture_master_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }
}
