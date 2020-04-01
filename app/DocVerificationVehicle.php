<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocVerificationVehicle extends Model
{
    protected $table = 'doc_verification_vehicle';

    public $timestamps = false;

    protected $fillable = [
        'soat',
        'technom_review',
        'expi_date',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];
}
