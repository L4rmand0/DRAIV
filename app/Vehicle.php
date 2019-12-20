<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'driver_information_dni_id',
        'plate_id', 
        'type_v', 
        'owner_v', 
        'taxi_type',
        'taxi_Number_of_drivers',
        'soat_expi_date',
        'capacity',
        'service',
        'cylindrical_cc',
        'v_class',
        'model',
        'line',
        'brand',
        'color',
        'technomechanical_date'
    ];
}
