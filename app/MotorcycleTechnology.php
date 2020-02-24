<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorcycleTechnology extends Model
{
    const VALUE_TYPE_BRAKE = [4 => 'Ambas ruedas',2 => 'Una rueda',0 => 'Ninguna']; 
    const VALUE_ASSISTENCE_BRAKE = [5 => 'Frenos ABS',3 => 'Frenos CBS',0 => 'Sin Asistencia']; 
    const VALUE_AUTOMATIC_LIGHTS = [1 => 'Encendido Automático',0 => 'Encendido Manual']; 

    protected $table = 'motorcycle_technology'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'brake_type', 
        'assistence_brake', 
        'automatic_lights', 
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];

    public function user_vehicle(){
        return $this->belongsTo(DriverVehicle::class,'id','user_vehicle_id');
    }
}
