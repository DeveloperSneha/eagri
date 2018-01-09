<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model {

    protected $primaryKey = 'idVillage';
    protected $table = 'village';

    public function block() {
        return $this->belongsTo(Block::class, 'idBlock', 'idVillage');
    }

}
