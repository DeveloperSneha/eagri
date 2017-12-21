<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerAppliedScheme extends Model
{
    protected $primaryKey = 'idAppliedScheme';
    protected $table = 'farmerapplied_scheme';
    protected $fillable = ['idFarmer','idScheme','idProgram','idCategory','idComponent','areaApplied','previouslyApplied'];

    public function scheme() {
        return $this->belongsTo(Scheme::class,'idScheme','idScheme');
    }
     public function program() {
        return $this->belongsTo(Program::class,'idProgram','idProgram');
    }
    public function farmer() {
        return $this->belongsTo(Farmer::class,'idFarmer','idFarmer');
    }
}
