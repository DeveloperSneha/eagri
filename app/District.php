<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

    protected $table = 'districts';

    public function blocks() {
        return $this->hasMany(Block::class, 'district_id', 'id');
    }

}
