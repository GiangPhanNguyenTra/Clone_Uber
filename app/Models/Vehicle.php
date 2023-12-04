<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Vehicle extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'tbl_vehicles';
    protected $primaryKey = 'license_plates';
    protected $fillable = [
        'license_plates',
        'brand',
        'color',
        'model_code',
        'driver_id'
    ];  

    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
