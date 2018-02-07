<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'idUser';
    protected $fillable = [
        'idUser', 'name', 'userName', 'fatherName', 'motherName', 'dob', 'address', 'ofc_address', 'password', 'aadhaar', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userdesig() {
        return $this->hasMany(UserDesignationDistrictMapping::class, 'idUser', 'idUser');
    }

//    public function designations() {
//        return $this->hasMany(PermissionDesig::class, 'idPermission', 'idPermission');
//    }

    public function setDobAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['dob'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['dob'] = null;
    }

    public function getDobAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

public function roles() {
    return $this->belongsToMany(Role::class,'role_user','idUser', 'idRole');
  }

  public function hasRole($role) {
    if (is_string($role)) {
      return $this->roles->contains('name', $role);
    }
    return !!$role->intersect($this->roles)->count();
  }

  public function getRoleIdAttribute() {
    $role = $this->roles->first();
    return $role ? $role->id : 0;
  }
}
