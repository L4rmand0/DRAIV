<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocVerification extends Model
{
    protected $table = 'doc_verification'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'user_vehicle_id', 
        'type_v', 
        'date_operation', 
    ];
}
