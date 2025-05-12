<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'feedback' => 'boolean',
    ];
}
