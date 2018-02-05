<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkflowStep extends Model {

  //  public $timestamps = false;
    protected $primaryKey = 'idworkflowstep';
    protected $table = 'workflowsteps';
    protected $fillable = ['idWorkflow', 'idSection', 'idDesignation'];

    public function designation() {
        return $this->belongsTo(Designation::class, 'idDesignation', 'idDesignation');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'idSection', 'idSection');
    }

    public function workflow() {
        return $this->belongsTo(Workflow::class, 'idWorkflow', 'idWorkflow');
    }

}
