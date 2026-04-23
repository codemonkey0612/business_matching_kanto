<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrefectureMaster extends Model
{
    protected $fillable = ['name', 'area_group', 'sort_order'];
}
