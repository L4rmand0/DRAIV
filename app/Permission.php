<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date_operation',
        'operation',
        'users_id',
        'module_module_id'
    ];
}
