<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillMtM extends Model
{
    const VALUE_SLALOM = [0 => 'regular', 1 => 'bueno']; 
    const VALUE_PROJECTION = [0=>'Muy malo',1=>'Malo',2=>'Regular',3=>'Bueno']; 
    const VALUE_BRAKING = [0=>'Muy malo',1=>'Malo',2=>'Regular',3=>'Bueno']; 
    const VALUE_EVASION = [0=>'Muy malo',1=>'Malo',2=>'Regular',3=>'Bueno']; 
    const VALUE_MOBILITY = [0=>'Muy malo',1=>'Malo',2=>'Regular',3=>'Bueno']; 
    
    protected $table = 'skill_m_t_m'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'date_evaluation', 
        'slalom', 
        'projection', 
        'braking',
        'evasion',
        'mobility',
        'result',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];

    public function user_vehicle(){
        return $this->belongsTo(DriverVehicle::class,'id','user_vehicle_id');
    }

}
