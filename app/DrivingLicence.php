<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    protected $table = 'driving_licence'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'driver_information_dni_id', 
        'licence_num', 
        'country_expedition', 
        'category', 
        'state',
        'expedition_day',
        'expi_date'
    ];
}
