<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocVerification extends Model
{
    const CATEGORY = ['A1','A2','B1','B2','B3','C1','C2','C3','Otro'];
    const RUNSTATE = ['Vigente','Vencida','Suspendida'];
    protected $table = 'doc_verification';

    public $timestamps = false;

    protected $fillable = [
        'doc_id',
        'valid_licence',
        'category',
        'soat_avalaible',
        'technom_review',
        'technom_expi_date',
        'run_state',
        'accident_rate',
        'penalty_record',
        'date_penalty_1',
        'date_penalty_2',
        'date_penalty_3',
        'date_penalty_4',
        'date_penalty_5',
        'code_penalty_1',
        'code_penalty_2',
        'code_penalty_3',
        'code_penalty_4',
        'code_penalty_5',
        'validated_data',
        'user_vehicle_id',
    ];
}
