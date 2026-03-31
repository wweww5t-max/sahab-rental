<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   protected $fillable = [
    'contract_number',
    'customer_id',
    'vehicle_id',
    'created_by',
    'start_date',
    'end_date',
    'rent_days',
    'daily_rate',
    'vat_amount',
    'total_amount',
    'terms',
    'status',
];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}