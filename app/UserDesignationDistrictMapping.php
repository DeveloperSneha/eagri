<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDesignationDistrictMapping extends Model {

    public $timestamps = false;
    protected $primaryKey = 'iddesgignationdistrictmapping';
    protected $table = 'user_designation_district_mapping';
    protected $fillable = ['idUser', 'idDesignation', 'idDistrict', 'idBlock', 'idVillage'];

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function designation() {
        return $this->belongsTo(Designation::class, 'idDesignation', 'idDesignation');
    }

    public function user() {
        return $this->belongsTo(User::class,'idUser','idUser');
    }

}
