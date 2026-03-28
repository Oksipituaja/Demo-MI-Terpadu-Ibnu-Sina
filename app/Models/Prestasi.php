<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    /** @use HasFactory<\Database\Factories\PrestasiFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'featured_image',
        'achievement_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'achievement_date' => 'date',
        ];
    }
}
