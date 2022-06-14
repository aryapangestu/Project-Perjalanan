<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'user_id');
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id', 'user_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
