<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model {

    //
    protected $primaryKey = 'idComponent';
    protected $table = 'component';
    protected $fillable = ['idCategory', 'componentName', 'isActive'];

    public function category() {
        return $this->belongsTo(Category::class, 'idCategory', 'idCategory');
    }

}
