<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model {

    protected $primaryKey = 'idBlock';
    protected $table = 'block';

    public function villages() {
        return $this->hasMany(Village::class, 'idBlock', 'idVillage');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idBlock');
    }

}
