<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchDistrictDistribution extends Model {

    protected $primaryKey = 'idSchemDistributionDistrict';
    protected $table = 'schemedistributiondistrict';
    protected $fillable = ['idSchemDistributionDistrict', 'idSchemeActivation', 'idDistrict', 'amountDistrict', 'areaDistrict'];

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function schactivation() {
        return $this->hasOne(SchemeActivation::class, 'idSchemeActivation', 'idSchemeActivation');
    }

}
