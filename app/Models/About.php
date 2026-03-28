<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'principal_name',
        'content',
        'featured_image',
        'key',
    ];
}
