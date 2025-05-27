<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * 当前表没有时间字段，防止自动维护
     * @var bool
     */
    public $timestamps = false;

    public $fillable = ['name', 'description'];

}
