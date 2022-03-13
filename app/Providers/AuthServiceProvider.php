<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\GetOrgTypeService;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logged-in', function($user){

            return $user;

        });

        Gate::define('is-admin', function($user){
            
            return $user->hasAnyRole('Membership Admin');
            
        });

        Gate::define('is-student', function($user){
            
            return $user->hasAnyRole('User');
            
        });
        Gate::define('is-studentservices', function($user){
            
            return $user->hasAnyRole('Head of Student Services');
            
        });

        Gate::define('is-academic', function($user){

            $orgTypeId = (new GetOrgTypeService)->getOrganizationID();
            $TypeId = $orgTypeId->organization_type_id;
            
            if ($TypeId == 1) {
                return $TypeId;
            }
            
        });
        Gate::define('is-nonacademic', function($user){

            $orgTypeId = (new GetOrgTypeService)->getOrganizationID();
            $TypeId = $orgTypeId->organization_type_id;

            if ($TypeId == 2) {
                return $TypeId;
            }
            
        });
    }
}
