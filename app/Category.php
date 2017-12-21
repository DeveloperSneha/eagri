<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $primaryKey = 'idCategory';
    protected $table = 'category';
    protected $fillable = ['idProgram', 'categoryName'];

    public function program() {
        return $this->belongsTo(Program::class, 'idProgram', 'idProgram');
    }

}
