<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Customer;

class Ride extends Model
{
    use HasFactory;

    protected $table = 'tbl_rides';
    protected $primaryKey = 'ride_id';
    protected $fillable = [
        'start_location_name',
        'start_location_lat',
        'start_location_lng',
        'end_location_name',
        'end_location_lat',
        'end_location_lng',
        'distance',
        'price',
        'status_code',
        'status_description',
        'start_time',
        'end_time',
        'rating',
        'comment',
        'driver_id',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
