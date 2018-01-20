<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchemeApproveReject extends Model {

    //
    public $timestamps = false;
    protected $primaryKey = 'idSchemeappreject';
    protected $table = 'schemeappreject';
    protected $fillable = ['idAppliedScheme', 'idDesignation', 'idWorkflow', 'status', 'haveChecked','remarks'];

    public function applied_scheme() {
        return $this->belongsTo(FarmerAppliedScheme::class, 'idAppliedScheme', 'idAppliedScheme');
    }

}
