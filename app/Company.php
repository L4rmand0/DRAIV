<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company'; 

    protected $primaryKey = 'company_id';
    
    public $timestamps = false;
    
    protected $fillable = [
        'company_id', 
        'name_company', 
        'main_company', 
        'child_company', 
        'type_company', 
        'date_operation',
        'user_id',
        'operation', 
    ];

    public function user(){
        return $this->hasMany(User::class,'company_id','company_id');
    }
}
