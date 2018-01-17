<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchSubdivisionDistribution extends Model
{
    protected $primaryKey = 'idSchemDistributionSubdivision';
    protected $table = 'schemedistributionsubdivision';
    protected $fillable = ['idSchemDistributionSubdivision', 'idSchemeActivation', 'schemeDistributionDistrict','idSubdivision', 'amountSubdivision', 'areaSubdivision'];

    public function district() {
        return $this->belongsTo(District::class, 'schemeDistributionDistrict', 'idDistrict');
    }

    public function subdivision() {
        return $this->belongsTo(Subdivision::class, 'idSubdivision', 'idSubdivision');
    }
    public function schactivation() {
        return $this->hasOne(SchemeActivation::class, 'idSchemeActivation', 'idSchemeActivation');
    }
}
