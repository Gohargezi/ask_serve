<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'score' => 'float',
        'number_of_raters' => 'integer',
    ];
}
