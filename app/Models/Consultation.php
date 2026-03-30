<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'reply',
        'replied_at',
        'status',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isReplied(): bool
    {
        return $this->status === 'replied';
    }
}
