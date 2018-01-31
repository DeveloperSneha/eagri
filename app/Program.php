<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {

    protected $primaryKey = 'idProgram';
    protected $table = 'program';
    protected $fillable = ['idScheme', 'programName','isVendorRequired', ];

    public function section() {
        return $this->belongsTo(Section::class, 'idSection', 'idSection');
    }
    public function scheme() {
        return $this->belongsTo(Scheme::class, 'idScheme', 'idScheme');
    }

}
