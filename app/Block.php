<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model {

    protected $table = 'blocks';

    public function villages() {
        return $this->hasMany(Village::class, 'block_id', 'id');
    }

    public function district() {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

}
