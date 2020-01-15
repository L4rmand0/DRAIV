<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocVerification extends Model
{
    protected $table = 'doc_verification'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'validated_data', 
        'type_v', 
    ];
}
