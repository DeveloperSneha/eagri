<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $primaryKey = 'idPermission';
    protected $table = 'permissions';
    protected $fillable = ['name', 'label'];

    public function roles() {
       return $this->belongsToMany(Role::class,'permission_role','idPermission', 'idRole');
    }

    public function designations() {
        return $this->hasMany(PermissionDesig::class, 'idPermission', 'idPermission');
    }

}
