<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','password','father_name','mother_name','aadhaar','rcno',
        'farmer_category','gender','marital_status','caste','mobile','schdistrict','schblock',
        'schvillage','bank_name','bank_branch','ifsc_code','account_no','land_location','land_owner','total_land'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
