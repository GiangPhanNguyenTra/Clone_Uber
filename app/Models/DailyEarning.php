<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class DailyEarning extends Model
{
    use HasFactory;

    protected $table = 'table_daily_earnings';
    protected $primaryKey = 'daily_earnings_id';
    protected $fillable = [
        'total_rides',
        'total_earnings',
        'date',
        'driver_id',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
