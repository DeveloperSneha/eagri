<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Farmer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'farmer';
    protected $primaryKey = 'idFarmer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','father_name','mother_name','aadhaar','rcno','password',
        'farmer_category','gender','marital_status','caste','mobile','idDistrict','idBlock',
        'idVillage','bank_name','bank_branch','ifsc_code','account_no','land_location','land_owner','total_land'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function schemes() {
        return $this->hasMany(FarmerAppliedScheme::class,'idFarmer','idFarmer');
    }
    public function district() {
        return $this->belongsTo(District::class,'idDistrict','idDistrict');
    }
    public function block() {
        return $this->belongsTo(Block::class,'idBlock','idBlock');
    }
    public function village() {
        return $this->belongsTo(Village::class,'idVillage','idVillage');
    }
}