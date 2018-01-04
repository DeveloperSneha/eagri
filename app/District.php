<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

    protected $primaryKey = 'idDistrict';
    protected $table = 'district';

    public function subdivision() {
        return $this->hasMany(Subdivision::class, 'idDistrict', 'idSubdivision');
    }

    public function blocks() {
        return $this->hasMany(Block::class, 'idDistrict', 'idBlock');
    }

}
