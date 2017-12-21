<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
	protected $primaryKey = 'idUnit';
    protected $table = 'units';
    protected $fillable = ['unitName','unitType','idBaseUnit','conversionMultipierToBase'];
}
