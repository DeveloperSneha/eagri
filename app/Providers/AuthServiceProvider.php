<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate) {
        $this->registerPolicies($gate);
        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function($user) use ($permission) {
                if ($user->idUser == 1)
                    return true;
                return $user->hasDesignation($permission->designations);
            });
        }
    }

    protected function getPermissions() {
       return Permission::with('designations')->get();
    }

}
