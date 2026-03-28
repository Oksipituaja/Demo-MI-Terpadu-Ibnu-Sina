<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'featured_image',
    ];
}
