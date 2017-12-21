<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {

    protected $primaryKey = 'idCertificate';
    protected $table = 'certificates';
    protected $fillable = ['certificateName', 'description'];

}
