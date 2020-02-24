<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocVerification extends Model
{
    const CATEGORY = ['A1','A2','B1','B2','B3','C1','C2','C3','Otro'];
    const RUNSTATE = ['Vigente','Vencida','Suspendida'];
    const SOAT_AVAILABLE = ['Y','N'];
    const TECHNOM_REVIEW = ['Y','N'];
    protected $table = 'doc_verification';

    public $timestamps = false;

    protected $fillable = [
        'doc_id',
        'valid_licence',
        'category',
        'soat_available',
        'technom_review',
        'technom_expi_date',
        'run_state',
        'accident_rate',
        'penality_record',
        'date_penality_1',
        'date_penality_2',
        'date_penality_3',
        'date_penality_4',
        'date_penality_5',
        'code_penality_1',
        'code_penality_2',
        'code_penality_3',
        'code_penality_4',
        'code_penality_5',
        'validated_data',
        'user_id',
        'date_operation',
        'operation',
        'user_vehicle_id',
    ];
}
