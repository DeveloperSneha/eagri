<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model {

    //
   // public $timestamps = false;
    protected $primaryKey = 'idWorkflow';
    protected $unique ='workflowName';
    protected $table = 'workflow';
    protected $fillable = ['workflowName'];

    public function steps() {
        return $this->hasMany(WorkflowStep::class, 'idWorkflow', 'idWorkflow');
    }
    
}

