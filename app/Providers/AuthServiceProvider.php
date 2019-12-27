<?php

namespace App\Providers;

use App\Formonderdeel;
use App\Raadsheer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('raadsheer-onderdeel', function (Raadsheer $raadsheer, Formonderdeel $formonderdeel){
            return $raadsheer->formOnderdelen->contains($formonderdeel);
        });

        //
    }
}
