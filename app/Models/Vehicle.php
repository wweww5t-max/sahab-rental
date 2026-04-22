<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'plate_number',
        'color',
        'chassis_number',
        'daily_rate',
        'status',
    ];
}