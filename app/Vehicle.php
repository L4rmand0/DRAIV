<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    const enum_type_v = [
        'Motos',
        'Camperos',
        'Camionetas',
        'Vehículos de carga o mixtos',
        'vehículos oficiales especiales y ambulancias',
        'Autos familiares',
        'Vehículos particulares para seis (6) o más pasajeros',
        'Autos de negocios',
        'Taxis',
        'Microbuses urbanos',
        'Buses y busetas',
        'Vehículos de servicio público intermunicipal'
    ];

    const AUTOS = [
        'Camperos',
        'Camionetas',
        'Vehículos de carga o mixtos',
        'vehículos oficiales especiales y ambulancias',
        'Autos familiares',
        'Vehículos particulares para seis (6) o más pasajeros',
        'Autos de negocios',
        'Taxis',
        'Microbuses urbanos',
        'Buses y busetas',
        'Vehículos de servicio público intermunicipal'
    ];

    const MOTOS = [
        'Motos'
    ];

    const enum_service = [
        'Particular',
        'Publico',
        'Transporte_mercancia',
        'Otros'
    ];

    const enum_taxi_type = [
        'Taxi amarillo',
        'Taxi blanco',
        'Na'
    ];

    protected $table = 'vehicle'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'plate_id', 
        'type_v', 
        'owner_v', 
        'taxi_type',
        'number_of_drivers',
        'soat_expi_date',
        'capacity',
        'service',
        'cylindrical_cc',
        'v_class',
        'model',
        'line',
        'brand',
        'color',
        'technomechanical_date',
        'company_id'
    ];

    
}
