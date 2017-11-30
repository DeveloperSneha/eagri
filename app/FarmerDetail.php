<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerDetail extends Model
{
    //
    protected $table = 'farmer_details';
    protected $fillable = ['name','father_name','mother_name','aadhaar','rcno',
        'farmer_category','gender','marital_status','caste','mobile','schdistrict','schblock',
        'schvillage','bank_name','bank_branch','ifsc_code','account_no','land_location','land_owner','total_land'];
}
