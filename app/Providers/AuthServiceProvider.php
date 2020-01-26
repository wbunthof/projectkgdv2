<?php

namespace App\Providers;

use App\Formonderdeel;
use App\Gilde;
use App\Leden;
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

        Gate::define('gilde-update-leden', function (Gilde $gilde, Leden $lid) {
            return $lid->gilde_id == $gilde->id;
        });

        Gate::define('lid-vrij', function (Gilde $gilde, Leden $lid){
            return !(isset($lid->gilde_id));
        });

        //
    }
}
