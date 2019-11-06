<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use App\Formonderdeel;
use App\Gilde;
use App\Discipline;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $volgordePagina = array('deelname', 'gildemis', 'optocht', 'tentoonstelling', 'bazuinblazen', 'geweer', 'kruis-handboog', 'standaardrijden', 'trommen', 'vendelen', 'junioren & leden zonder pas', 'deelname meerdere wedstrijden');
        $volgordePaginaZonderOpmaak = array('deelname', 'gildemis', 'optocht', 'tentoonstelling', 'bazuinblazen', 'geweer', 'kruis-handboog', 'standaardrijden', 'trommen', 'vendelen', 'junioren');
        $formonderdelenVragen = DB::table('vraag')->select('formonderdeel')->distinct()->get();
        View::share('volgordePaginaZonderOpmaak', $volgordePaginaZonderOpmaak);
        View::share('volgordePagina', $volgordePagina);
        View::share('formonderdelen', Formonderdeel::all());
        View::share('disciplines', Discipline::all());
        View::share('readonly', true);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
