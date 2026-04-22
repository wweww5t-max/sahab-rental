<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'full_name',
        'national_id',
        'mobile',
        'license_number',
        'nationality',
        'notes',
    ];
}