<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    const enum_tipo_doc = [
        'Fotografía_rostro',
        'Cedula_frente',
        'Cedula_reverso',
        'Eps_frente','Eps_reverso',
        'Licencia_transito_frente',
        'Licencia_transito_reverso',
        'Licencia_conducción_frente',
        'Licencia_conducción_reverso',
        'Fondo_pension',
        'ARL','SOAT_frente',
        'Tecnomecanica_frente',
        'Tecnomecanica_reverso',
        'Seguro',
        'Tarjeton_taxi',
        'Casco',
        'Foto_usuario_moto'
    ];

    const REQUIRED_DOCUMENTS = [
        'Fotografía Usuario'=>'Fotografía_rostro',
        'Cedula Frente'=>'Cedula_frente',
        'Cedula Reverso'=>'Cedula_reverso',
        'Licencia Tránsito Frente'=>'Licencia_transito_frente',
        'Licencia Tránsito Reverso'=>'Licencia_transito_reverso',
        'Licencia Conducción Frente'=>'Licencia_conducción_frente',
        'Licencia Conducción Reverso'=>'Licencia_conducción_reverso',
        'SOAT Frente'=>'SOAT_frente',
        'Tecnomecánica Frente'=>'Tecnomecanica_frente',
        'Tecnomecánica Reverso'=>'Tecnomecanica_reverso',
    ];

    const enum_assoc_tipo_doc = [
        'Fotografía Usuario'=>'Fotografía_rostro',
        'Cedula Frente'=>'Cedula_frente',
        'Cedula Reverso'=>'Cedula_reverso',
        'Eps Frente'=>'Eps_frente',
        'Eps Reverso'=>'Eps_reverso',
        'Licencia Tránsito Frente'=>'Licencia_transito_frente',
        'Licencia Tránsito Reverso'=>'Licencia_transito_reverso',
        'Licencia Conducción Frente'=>'Licencia_conducción_frente',
        'Licencia Conducción Reverso'=>'Licencia_conducción_reverso',
        'Fondo Pension'=>'Fondo_pension',
        'ARL'=>'ARL',
        'SOAT Frente'=>'SOAT_frente',
        'Tecnomecánica Frente'=>'Tecnomecanica_frente',
        'Tecnomecánica Reverso'=>'Tecnomecanica_reverso',
        'Seguro'=>'Seguro',
        'Tarjetón Taxi'=>'Tarjeton_taxi',
        'Casco'=>'Casco',
        'Foto Usuario Moto'=>'Foto_usuario_moto',
    ];

    const enum_assoc_driver_tipo_doc = [
        'Fotografía Usuario'=>'Fotografía_rostro',
        'Cedula Frente'=>'Cedula_frente',
        'Cedula Reverso'=>'Cedula_reverso',
        'Eps Frente'=>'Eps_frente',
        'Eps Reverso'=>'Eps_reverso',
        'Licencia Tránsito Frente'=>'Licencia_transito_frente',
        'Licencia Tránsito Reverso'=>'Licencia_transito_reverso',
        'Licencia Conducción Frente'=>'Licencia_conducción_frente',
        'Licencia Conducción Reverso'=>'Licencia_conducción_reverso',
        'Fondo Pension'=>'Fondo_pension',
        'ARL'=>'ARL',
        'SOAT Frente'=>'SOAT_frente',
        'Tecnomecánica Frente'=>'Tecnomecanica_frente',
        'Tecnomecánica Reverso'=>'Tecnomecanica_reverso',
        'Seguro'=>'Seguro',
        'Tarjetón Taxi'=>'Tarjeton_taxi',
        'Casco'=>'Casco',
        'Foto Usuario Moto'=>'Foto_usuario_moto',
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
