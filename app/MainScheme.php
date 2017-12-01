<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainScheme extends Model {

    //
    protected $table = 'schemes';
    protected $fillable = ['name'];

    public function sub_scheme() {
        return $this->hasMany(SubScheme::class, 'scheme_id', 'id');
    }

    public function scheme_component() {
        return $this->hasMany(SchemeComponent::class, 'scheme_id', 'id');
    }

}
