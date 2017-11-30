<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model {

    protected $table = 'villages';

    public function block() {
        return $this->belongsTo(Block::class,'block_id','id');
    }

}
