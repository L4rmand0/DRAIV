<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    const enum_country_expedition = ['Colombia'];
    // const enum_country_expedition = ['Colombia','Venezuela','Argentina','Brasil','Ecuador','Bolivia','Otro'];
    const enum_category = ['A1','A2','B1','B2','B3','C1','C2','C3','Otro'];
    const enum_state = ['Vigente','Vencida','suspendida'];
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
