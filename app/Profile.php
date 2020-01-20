<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile_';

    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = [
        'user_profile',
        'permission',
        'transactions',
        'date_operation',
        'user_id',
        'operation',
    ];
}
