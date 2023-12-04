<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class DrivingLicense extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'tbl_driving_licenses';
    protected $primaryKey = 'driving_license_id';
    protected $fillable = [
        'driving_license_id',
        'full_name',
        'date_of_birth',
        'address',
        'class',
        'expires',
        'beginning_date',
        'date_of_issue',
        'issued_by',
        'driver_id'
    ];

    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
