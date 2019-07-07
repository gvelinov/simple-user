<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (\Schema::hasTable('permissions')) {
            $permissions = Permission::pluck('ident');
            $permissions->each(function (string $ident) {
                Gate::define($ident, function (User $user) use ($ident) {
                    $userClosure = function ($query) use ($user) {
                        $query->where('users.id', '=', $user->id);
                    };
                    $userPermissions = Permission::query()
                        ->whereHas('roles', function ($query) use ($userClosure) {
                            $query->whereHas('users', $userClosure);
                        })
                        ->groupBy('permissions.id')
                        ->pluck('ident');

                    if (in_array($ident, $userPermissions->toArray())) {
                        return true;
                    }

                    return false;
                });
            });
        }
    }
}