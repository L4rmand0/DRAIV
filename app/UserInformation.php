<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'User_information'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'DNI_id', 
        'First_name', 
        'Second_name', 
        'F_last_name',
        'S_last_name',
        'Gender',
        'Education',
        'E_mail_address',
        'address',
        'Country_born',
        'City_born',
        'Department',
        'phone',
        'Civil_state',
        'Operation',
        'Db_user_id',
        'Company_id'
    ];
}
