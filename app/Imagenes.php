<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    const enum_tipo_doc = [
        'Fotografía_rostro',
        'Cedula_frente',
        'Cedula_reverso',
        'Eps_frente',
        'Eps_reverso',
        'Fondo_pension',
        'ARL',
        'Tarjeton_taxi',
        'Casco',
        'Foto_usuario_moto'
    ];

    const enum_assoc_tipo_doc = [
        'Foto'=>'Fotografía_rostro',
        'Cédula Frente'=>'Cedula_frente',
        'Cedula reverso'=>'Cedula_reverso',
        'Eps Frente'=>'Eps_frente',
        'Eps Reverso'=>'Eps_reverso',
        'Pensión'=>'Fondo_pension',
        'ARL'=>'ARL',
        'Tarjetón Taxi'=>'Tarjeton_taxi',
        'Casco'=>'Casco',
        'Foto Conductor Moto'=>'Foto_usuario_moto'
    ];


    protected $table = 'imagenes'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'tipo_doc', 
        'url', 
        'size_image', 
        'type_image',
        'user_id',
        'date_operation',
        'operation',
        'driver_information_dni_id'
    ];
}
