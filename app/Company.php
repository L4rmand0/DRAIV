<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'company_id', 
        'company_name', 
        'main_company', 
        'child_company', 
        'type_company', 
        'date_operation',
        'user_id',
        'operation', 
    ];
}
