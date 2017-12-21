<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchBlockDistribution extends Model {

    protected $primaryKey = 'idSchemDistributionBlock';
    protected $table = 'schemedistributionblock';
    protected $fillable = ['idSchemDistributionBlock', 'idSchemeActivation', 'schemeDistributionDistrict','idBlock', 'amountBlock', 'areaBlock'];

    public function district() {
        return $this->belongsTo(District::class, 'schemeDistributionDistrict', 'idDistrict');
    }

    public function block() {
        return $this->belongsTo(Block::class, 'idBlock', 'idBlock');
    }
    public function schactivation() {
        return $this->hasOne(SchemeActivation::class, 'idSchemeActivation', 'idSchemeActivation');
    }

}
