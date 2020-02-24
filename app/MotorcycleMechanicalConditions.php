<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorcycleMechanicalConditions extends Model
{
    const VALUE_TIRES = [2 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_MANIGUETA_GUAYA = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_BRAKING_SYSTEM = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_KIT = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_STEE_SUSP = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_OIL_LEAK = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_OTHER_COMPONENTS = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_HORN = [1 => 'Buen estado',0 => 'Mal estado']; 
    const VALUE_LIGHTS = [2 => 'Buen estado',0 => 'Mal estado']; 

    protected $table = 'motorcycle_mechanical_conditions'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'date_evaluation', 
        'name_evaluator', 
        'tires', 
        'manigueta_guaya',
        'braking_system',
        'kit',
        'stee_susp',
        'oil_leak',
        'other_components',
        'horn',
        'lights',
        'm_results',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];

    public function user_vehicle(){
        return $this->belongsTo(DriverVehicle::class,'id','user_vehicle_id');
    }
}
