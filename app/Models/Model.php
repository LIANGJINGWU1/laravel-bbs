<?php

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
