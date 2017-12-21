<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compcert extends Model {

    //
    protected $primaryKey = 'idCompCerts';
    protected $table = 'compcerts';
    protected $fillable = ['idCertificate', 'idComponent'];

    public function component() {
        return $this->belongsTo(Component::class, 'idComponent', 'idComponent');
    }

    public function certificate() {
        return $this->belongsTo(Certificate::class, 'idCertificate', 'idCertificate');
    }

}
