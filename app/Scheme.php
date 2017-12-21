<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model {

    //
    protected $primaryKey = 'idScheme';
    protected $table = 'scheme';
    protected $fillable = ['idScheme', 'idSection', 'schemeName', 'remarks'];

    public function section() {
        return $this->belongsTo(Section::class, 'idSection', 'idSection');
    }

    public function programs() {
        return $this->hasMany(Program::class, 'idScheme', 'idScheme');
    }

}
