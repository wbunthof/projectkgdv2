<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use App\Formonderdeel;
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
//        $volgordePaginaZonderOpmaak = array('deelname', 'gildemis', 'optocht', 'tentoonstelling', 'bazuinblazen', 'geweer', 'kruis-handboog', 'standaardrijden', 'trommen', 'vendelen', 'junioren');
//        $formonderdelenVragen = DB::table('vraag')->select('formonderdeel_id')->distinct()->get();
//        $formonderdelenVragen = Formonderdeel::all('onderdeel');
//        View::share('volgordePaginaZonderOpmaak', $volgordePaginaZonderOpmaak);
//        View::share('disciplines', Discipline::all());

        Schema::defaultStringLength(191);

        if (Schema::hasTable('formonderdelen'))
        {
            View::share('volgordePagina', Formonderdeel::where('id', '!=', 0)->get());
            View::share('formonderdelen', Formonderdeel::all());
        }
        View::share('readonly', env('slot', false));
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
