<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model {
  //  public $timestamps = false;
    protected $primaryKey = 'idDesignation';
    protected $table = 'designation';
    protected $fillable = ['designationName', 'idSection', 'level'];

    public function section() {
        return $this->belongsTo(Section::class, 'idSection', 'idSection');
    }

}
