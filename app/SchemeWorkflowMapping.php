<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchemeWorkflowMapping extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idschemeworkflow';
    protected $table = 'scheme_workflow_mapping';
    protected $fillable = ['idScheme','idWorkflow'];
}
