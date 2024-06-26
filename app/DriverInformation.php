<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverInformation extends Model
{

    const enum_education = ['Ninguno','primaria','secundaria','pregrado','postgrado','sin información'];
    const enum_country_born = ['colombia'];
    const enum_civil_state = ['soltero','casado','separado','divorciado','Viudo','Union libre','sin información'];

    protected $table = 'driver_information'; 

    protected $guarded = [];
    
    public $timestamps = false;
    
    protected $fillable = [
        'dni_id', 
        'first_name', 
        'second_name', 
        'f_last_name',
        's_last_name',
        'gender',
        'born_date',
        'education',
        'e_mail_address',
        'address',
        'country_born',
        'city_residence_place',
        'city_born',
        'department',
        'phone',
        'civil_state',
        'number_of_vehicles',
        'score',
        'user_id',
        'operation',
        'date_operation',
        'db_user_id',
        'company_id'
    ];
}
