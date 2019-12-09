<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'Vehicle'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'User_information_DNI_id',
        'Plate_id', 
        'Type_V', 
        'Owner_V', 
        'Taxi_type',
        'taxi_Number_of_drivers',
        'Soat_expi_date',
        'Capacity',
        'Service',
        'Cylindrical_cc',
        'V_class',
        'Model',
        'Line',
        'Brand',
        'Color',
        'technomechanical_date'
    ];
}
