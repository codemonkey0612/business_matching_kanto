<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuePartnerAffinity extends Model
{
    protected $fillable = ['issue_master_id', 'partner_type_master_id', 'score'];
}
