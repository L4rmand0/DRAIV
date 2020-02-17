<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    const MODULES = [
        'information' => 1, 
        'driver_information' => 2, 
        'driving_licence' => 3, 
        'vehicle' => 4, 
        'driver_images' => 5, 
        'administratrion'=> 6,
        'users'=> 7,
        'dashboard'=> 8,
        'doc_verification'=> 9,
        'autoevaluation_company'=> 10,
        'evaluation'=> 11,
        'human_component'=> 12,
        'manual_doc_verification'=> 13,
        'skills_m_t_m'=> 14,
        'mt_mechanical_condition'=> 15,
        'personal_ele_protection'=> 16,
        'certification'=> 17,
    ];

    protected $table = 'module';

    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = [
        'module_type',
        'type',
        'imagen',
        'parent_id',
        'route',
        'name',
        'date_operation',
        'user_id',
        'operation',
    ];
}
