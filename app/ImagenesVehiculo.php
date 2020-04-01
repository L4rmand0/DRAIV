<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenesVehiculo extends Model
{
    const enum_tipo_doc = [
        'SOAT_frente',
        'Tecnomecanica_frente',
        'Tecnomecanica_reverso',
        'Seguro',
        'Tarjeton_taxi' 
    ];

    const REQUIRED_DOCUMENTS = [
        'Soat de Frente'=>'SOAT_frente',
        'Tecnomecánica Frente'=>'Tecnomecanica_frente',
        'Tecnomecánica Reverso'=>'Tecnomecanica_reverso',
    ];

    const enum_assoc_tipo_doc = [
        'Soat de Frente'=>'SOAT_frente',
        'Tecnomecánica Frente'=>'Tecnomecanica_frente',
        'Tecnomecánica Reverso'=>'Tecnomecanica_reverso',
        'Seguro'=>'Seguro',
        'Tarjetón de Taxi'=>'Tarjeton_taxi',
    ];

    const ARR_ASSOC_TIPO_DOC_GENERAL = [
        ['title'=>'Soat de Frente','type'=>'SOAT_frente'],
        ['title'=>'Tecnomecánica Frente','type'=>'Tecnomecanica_frente'],
        ['title'=>'Tecnomecánica Reverso','type'=>'Tecnomecanica_reverso'],
        ['title'=>'Seguro','type'=>'Seguro'],
    ];

    const ARR_ASSOC_TIPO_DOC_TAXI = [
        ['title'=>'Soat de Frente','type'=>'SOAT_frente'],
        ['title'=>'Tecnomecánica Frente','type'=>'Tecnomecanica_frente'],
        ['title'=>'Tecnomecánica Reverso','type'=>'Tecnomecanica_reverso'],
        ['title'=>'Seguro','type'=>'Seguro'],
        ['title'=>'Tarjetón de Taxi','type'=>'Tarjeton_taxi'],
    ];


    protected $table = 'imagenes_vehiculo';
    
    public $timestamps = false;

    protected $fillable = [
        'tipo_doc',
        'url',
        'size_image',
        'type_image',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id'
    ];
}
