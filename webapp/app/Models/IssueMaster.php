<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueMaster extends Model
{
    protected $fillable = ['name', 'category_name', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
