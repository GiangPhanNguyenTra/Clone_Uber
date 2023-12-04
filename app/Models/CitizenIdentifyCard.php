<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class CitizenIdentifyCard extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'tbl_citizen_identify_cards';
    protected $primaryKey = 'citizen_identify_card_id';
    protected $fillable = [
        'citizen_identify_card_id',
        'full_name',
        'date_of_birth',
        'gender',
        'place_of_origin',
        'place_of_residence',
        'date_of_expiry',
        'date_of_issue',
        'issued_by',
        'driver_id'
    ];

    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
