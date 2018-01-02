<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    public $timestamps = false;
    protected $table = 'permissions';

    public function designations() {
        return $this->hasMany(PermissionDesig::class,'idPermission','idPermission');
    }

}