<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schemecert extends Model {

    //
    public $timestamps = false;
    protected $primaryKey = 'idSchemeCert';
    protected $table = 'schemecert';
    protected $fillable = ['idScheme', 'idProgram', 'idCertificate'];

}
