<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin1 extends Model
{

    protected $table = 'admin1'; 

    protected $guarded = [];
    
    public $timestamps = false;
    
    protected $fillable = [
        'name', 
    ];
}
