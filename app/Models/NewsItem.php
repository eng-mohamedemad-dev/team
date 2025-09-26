<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'content',
        'image',
        'is_active',
        'scheduled_at',
        'is_scheduled',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_scheduled' => 'boolean',
        'is_active' => 'boolean',
    ];
}


