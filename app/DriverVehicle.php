<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverVehicle extends Model
{

    protected $table = 'user_vehicle'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 
        'date_operation', 
        'operation', 
        'vehicle_plate_id', 
        'driver_information_dni_id' 
    ];
}
