<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubScheme extends Model {

    protected $table = 'subschemes';
    protected $fillable = ['scheme_id', 'name'];

    public function scheme_component() {
        return $this->hasMany(SchemeComponent::class, 'scheme_id', 'id');
    }

    public function scheme() {
        return $this->belongsTo(MainScheme::class, 'scheme_id', 'id');
    }

}