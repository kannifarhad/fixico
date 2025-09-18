<?php

namespace App\CarDamageReports\Models;

use Illuminate\Database\Eloquent\Model;

class CarDamageReports extends Model
{
    protected $table = 'car_damage_reports';

    protected $fillable = [
        'reporter_name',
        'car_model',
        'license_plate',
        'description',
        'damage_level',
        'is_resolved',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
    ];
}
