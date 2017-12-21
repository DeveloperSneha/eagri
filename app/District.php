<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

    protected $primaryKey = 'idDistrict';
    protected $table = 'district';

    public function blocks() {
        return $this->hasMany(Block::class, 'idDistrict', 'idBlock');
    }

}
