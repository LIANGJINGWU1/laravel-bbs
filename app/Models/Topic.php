<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Topic extends Pivot
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id',
        'category_id', 'reply_count', 'view_count',
        'last_reply_user_id', 'order', 'excerpt', 'slug'
    ];
}
