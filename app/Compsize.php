<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compsize extends Model {

    protected $primaryKey = 'idCompSize';
    protected $table = 'compsize';
    protected $fillable = ['idComponent', 'size', 'idUnit'];

    public function component() {
        return $this->belongsTo(Component::class, 'idComponent', 'idComponent');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'idUnit', 'idUnit');
    }

}
