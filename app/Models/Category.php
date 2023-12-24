<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'title',
        'content',
        'slug',
        'meta_description',
        'is_published',
        'user_id'
    ];
}
