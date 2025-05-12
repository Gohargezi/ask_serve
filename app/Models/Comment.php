<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $casts = [
        'likes_count' => 'integer',
        'dislikes_count' => 'integer',
        'organization_score' => 'integer',
        'organization_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
