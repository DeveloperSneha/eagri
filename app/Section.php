<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $primaryKey = 'idSection';
    protected $table = 'section';
    protected $fillable = ['sectionName'];
}
