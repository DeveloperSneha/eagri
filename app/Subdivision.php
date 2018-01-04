<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model {

    protected $primaryKey = 'idSubdivision';
    protected $table = 'subdivision';

    public function blocks() {
        return $this->hasMany(Block::class, 'idDistrict', 'idBlock');
    }

}
