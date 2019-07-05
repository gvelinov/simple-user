<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permission;

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

        $permissions = Permission::pluck('ident');
        $permissions->each(function(string $ident) {
            Gate::define($ident, function (User $user) {
                $userClosure = function ($query) use ($user) {
                    $query->where('users.id', '=', $user->id);
                };
                $userPermissions = Permission::query()
                    ->whereHas('roles', function ($query) use ($userClosure) {
                        $query->where('active', '=', 1)
                            ->whereHas('users', $userClosure);
                    })
                    ->orWhereHas('users', $userClosure)
                    ->groupBy('permissions.id')
                    ->where('active', '=', 1)
                    ->pluck('ident');

                if ($userPermissions) {
                    return true;
                }

                return false;
            });
        });
    }
}