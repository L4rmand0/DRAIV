<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'Name_company', 
        'First_name', 
        'Type_company', 
        'user_id'
    ];
}
