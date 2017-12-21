<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprate extends Model {

    protected $primaryKey = 'idCompRate';
    protected $table = 'comprate';
    protected $fillable = ['idCompSize', 'idSchemeActivation', 'ratePerUnit'];

    public function componentsize() {
        return $this->belongsTo(Compsize::class, 'idCompSize', 'idCompSize');
    }

    public function schactivation() {
        return $this->hasOne(SchemeActivation::class, 'idSchemeActivation', 'idSchemeActivation');
    }

}
