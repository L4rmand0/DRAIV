<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    protected $table = 'Driving_licence'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'User_information_DNI_id', 
        'Licence_num', 
        'Country_expedition', 
        'Category', 
        'State',
        'Expedition_day',
        'Expi_date'
    ];
}
