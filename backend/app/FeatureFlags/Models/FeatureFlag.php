<?php

namespace App\FeatureFlags\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureFlag extends Model
{
    protected $table = 'feature_flags'; 
    protected $fillable = [
        'key',
        'name',
        'description',
        'enabled',
        'rules',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'rules' => 'array',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
