<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchVillageDistribution extends Model {

    //
    protected $primaryKey = 'idSchemDistributionVillage';
    protected $table = 'schemedistributionvillage';
    protected $fillable = ['idSchemeActivation', 'schemeDistributionBlock', 'idVillage', 'amountVillage', 'areaVillage'];

    public function block() {
        return $this->belongsTo(Block::class, 'schemeDistributionBlock', 'idBlock');
    }

    public function schactivation() {
        return $this->hasOne(SchemeActivation::class, 'idSchemeActivation', 'idSchemeActivation');
    }

    public function village() {
        return $this->belongsTo(Village::class, 'idVillage', 'idVillage');
    }

}
