<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\CitizenIdentifyCard;
use App\Models\DrivingLicense;
use App\Models\Vehicle;
use App\Models\DailyEarning;
use App\Models\Ride;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'tbl_drivers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'avata',
        'phone',
        'address',
        'verify',
        'gender',
        'email',
        'password',
        'status_code',
        'status_description',
        'verify_token',
        'current_location_name',
        'current_location_lat',
        'current_location_lng'
    ];

    protected $guard_name = 'web';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function citizenIdentifyCard() {
        return $this->hasOne(CitizenIdentifyCard::class, 'driver_id', 'id');
    }

    public function drivingLicense() {
        return $this->hasOne(DrivingLicense::class, 'driver_id', 'id');
    }

    public function vehicle() {
        return $this->hasOne(Vehicle::class, 'driver_id', 'id');
    }

    public function rides() {
        return $this->hasMany(Ride::class, 'driver_id', 'id');
    }

    public function dailyEarnings() {
        return $this->hasMany(DailyEarning::class, 'driver_id', 'id');
    }
}