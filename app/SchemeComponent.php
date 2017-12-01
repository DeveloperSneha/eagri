<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchemeComponent extends Model {

    protected $table = 'scheme_components';
    protected $fillable = ['scheme_id', 'subscheme_id', 'name'];

    public function scheme() {
        return $this->belongsTo(MainScheme::class, 'scheme_id', 'id');
    }

    public function subscheme() {
        return $this->belongsTo(SubScheme::class, 'subscheme_id', 'id');
    }

}
