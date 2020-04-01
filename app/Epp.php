<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epp extends Model
{
    const VALUE_CASCO = [3 => 'Certificación Sharp >= 4',2 => 'Certificación ECE 2205',1 => 'Otra certificación',0 => 'No certificado']; 
    const VALUE_AIRBAG = [3 => 'Buen estado',0 => 'Sin airbag o mal Estado']; 
    const VALUE_RODILLERAS = [1 => 'Equipadas',0 => 'No equipadas']; 
    const VALUE_CODERAS = [1 => 'Equipadas',0 => 'No equipadas']; 
    const VALUE_HOMBRERAS = [1 => 'Equipadas',0 => 'No equipadas']; 
    const VALUE_ESPALDA = [1 => 'Equipadas',0 => 'No equipadas']; 
    const VALUE_BOTAS = [1 => 'Equipadas',0 => 'No equipadas']; 
    const VALUE_GUANTES = [1 => 'Equipadas',0 => 'No equipadas']; 

    protected $table = 'epp'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'name_evaluator', 
        'empresa', 
        'casco', 
        'airbag',
        'rodilleras',
        'coderas',
        'hombreras',
        'espalda',
        'botas',
        'guantes',
        'epp_results',
        'risk',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];

    public function user_vehicle(){
        return $this->belongsTo(DriverVehicle::class,'id','user_vehicle_id');
    }
}
