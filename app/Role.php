<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    //
    protected $primaryKey = 'idRole';
    protected $table = 'roles';
    protected $fillable = ['name', 'label', 'admin'];

    public function users() {
        return $this->belongsToMany(User::class,'role_user','idRole', 'idUser');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class,'permission_role','idRole', 'idPermission');
    }

    public function givePermissionTo($permission) {
        return $this->permissions()->save($permission);
    }

}
