<?php
//
// Code van Wouter
//

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/{email}/nieuwWW', function(){
//   return 'Hello World!';
// })->name('nieuwWW');

Auth::routes();

Route::get('/', 'IndexController@index')->name('home')->middleware('guest');
// Route::get('/mail', 'IndexController@mail')->name('mail');
Route::get('/disclaimer', 'IndexController@disclaimer')->name('disclaimer');

Route::get('/test', 'IndexController@test')->name('test');
Route::get('/nietIngevuld', 'IndexController@nietIngevuld')->name('nietIngevuld');


//admin
Route::prefix('admin')->group(function () {
  // Inlog gedeelte van de admin
  Route::middleware('guest', 'throttle:30,1')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

  });

  Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/account', 'AdminController@account')->name('admin.account');
    Route::put('/account', 'AdminController@accountUpdate')->name('admin.account.update');
    Route::get('/gilde', 'AdminController@gildenWeergeven')->name('admin.gilde.weergeven');
    Route::put('/gilde', 'AdminController@gildenOpslaanNieuw')->name('admin.gilde.nieuw');
    Route::delete('/gilde/verwijderen/', 'AdminController@gildenVerwijderen')->name('admin.gilde.verwijderen');
    Route::put('/gilde/nieuwWachtwoord/', 'AdminController@gildeNieuwWachtwoordAdmin')->name('admin.gilde.nieuwWachtwoord');

  });
});


//organiserend gilde
Route::prefix('organiser')->group(function () {
  // Inlog gedeelte van het organiserend gilde
  Route::middleware('guest', 'throttle:30,1')->group(function () {
    Route::get('/login', 'Auth\OrganiserLoginController@showLoginForm')->name('organiser.login');
    Route::post('/login', 'Auth\OrganiserLoginController@login')->name('organiser.login.submit');
  });

  Route::middleware('auth:organiser')->group(function () {
    Route::get('/dashboard', 'OrganiserController@index')->name('organiser.dashboard');
    Route::get('/account', 'OrganiserController@account')->name('organiser.account');
    Route::put('/account', 'OrganiserController@accountUpdate')->name('organiser.account.update');
    Route::get('/data', 'OrganiserController@data');

    Route::prefix('data')->group(function () {
      Route::get('/{NBFS}/gilde', 'DataController@gilde')->name('organiser.data.gilde');
      Route::get('/{ID}/onderdeel', 'DataController@onderdeel')->name('organiser.data.onderdeel');
      Route::get('/onderdeel', 'DataController@alleOnderdelen')->name('organiser.data.alleOnderdelen');
      Route::get('/{ID}/vraag', 'DataController@vraag')->name('organiser.data.vraag');
      Route::get('/{ID}/leden', 'DataController@leden')->name('organiser.data.leden');
      Route::get('/leden/zonderPas', 'DataController@zonderPas')->name('organiser.data.leden.zonderPas');
      Route::get('/leden/deelnameMeerdereWedstrijden', 'DataController@deelnameMeerdereWedstrijden')->name('organiser.data.leden.deelnameMeerdereWedstrijden');
    });
  });
});


//raadsheer
Route::prefix('raadsheer')->group(function () {
  // Inlog gedeelte van de raadsheer
  Route::middleware('guest', 'throttle:30,1')->group(function () {
    Route::get('/login', 'Auth\RaadsheerLoginController@showLoginForm')->name('raadsheer.login');
    Route::post('/login', 'Auth\RaadsheerLoginController@login')->name('raadsheer.login.submit');
  });

  Route::middleware('auth:raadsheer')->group(function () {
    Route::get('/dashboard', 'RaadsheerController@index')->name('raadsheer.dashboard');
  });
});

//gilde
Route::prefix('gilde')->group(function () {
  // Inlog gedeelte van het gilde
  Route::middleware('guest', 'throttle:30,1')->group(function () {
    Route::get('/login', 'Auth\GildeLoginController@showLoginForm')->name('gilde.login');
    Route::post('/login', 'Auth\GildeLoginController@login')->name('gilde.login.submit');
    Route::get('/NieuwWachtwoordGilde', 'Auth\GildeLoginController@FormNieuwWachtwoordGildeEmail')->name('NieuwWachtwoordGildeGET');
    Route::post('/NieuwWachtwoordGilde', 'Auth\GildeLoginController@NieuwWachtwoordGildeEmail')->name('NieuwWachtwoordGildePOST');
  });

  // Standaard gedeelte van het gilde (welkomstpagina, account)
  Route::middleware('auth:gilde')->group(function () {
    Route::get('/dashboard', 'GildeController@index')->name('gilde.dashboard');
    Route::get('/account', 'GildeController@account')->name('gilde.account');
    Route::put('/account', 'GildeController@accountUpdate')->name('gilde.account.update');

    // Alles voor het inschrijfformulier
    Route::prefix('/inschrijffomulier')->group(function (){

      //Deelname vraag 1
      Route::post('/deelnameOpslaan', 'inschrijfformulierController@deelnameOpslaan')->name('gilde.inschrijffomulier.deelnameOpslaan');

      // Deelname, Gildemis, Optocht, Tentoonstelling, Geweer, Kruis-handboog, Standaardrijden
      Route::get('/{formonderdeel}/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.deelname1');
      Route::put('/{formonderdeel}/formOpslaan', 'inschrijfformulierController@formOpslaan')->name('gilde.inschrijffomulier.formOpslaan');
      Route::post('/{formonderdeel}/vraagOpslaan', 'inschrijfformulierController@vraagOpslaan')->name('gilde.inschrijffomulier.vraagOpslaan');

      // Bazuinblazen, Trommen, Vendelen
      Route::get('/{formonderdeel}/2', 'inschrijfformulierController@formShowTable')->name('gilde.inschrijffomulier.deelname2');
      Route::put('/{formonderdeel}/lidToevoegen', 'inschrijfformulierController@lidToevoegen')->name('gilde.inschrijffomulier.lidToevoegen');
      Route::put('/juniorToevoegen', 'inschrijfformulierController@juniorToevoegen')->name('gilde.inschrijffomulier.juniorToevoegen');
      Route::delete('/{formonderdeel}/lidVerwijderen', 'inschrijfformulierController@lidVerwijderen')->name('gilde.inschrijffomulier.lidVerwijderen');
      Route::delete('/{formonderdeel}/juniorVerwijderen', 'inschrijfformulierController@juniorVerwijderen')->name('gilde.inschrijffomulier.juniorVerwijderen');
      Route::post('/{formonderdeel}/lidUpdaten', 'inschrijfformulierController@lidUpdaten')->name('gilde.inschrijffomulier.lidUpdaten');
      // AJAX call voor het aanvragen van leden
      Route::get('/lidopzoeken/{type}/{input}/{discipline}', 'IndexController@ajax')->name('lidopzoeken');

      // Deelname meerder wedstrijden
      Route::get('/deelname-meerdere-wedstrijden/3', 'inschrijfformulierController@formDeelnameMeerdereWedstrijden')->name('gilde.inschrijffomulier.deelname-meerdere-wedstrijden');
      Route::put('/deelname-meerdere-wedstrijden/3/Toevoegen', 'inschrijfformulierController@formDeelnameMeerdereWedstrijdenToevoegen')->name('gilde.inschrijffomulier.deelname-meerdere-wedstrijden.Toevoegen');
      Route::delete('/deelname-meerdere-wedstrijden/3/Verwijderen', 'inschrijfformulierController@formDeelnameMeerdereWedstrijdenVerwijderen')->name('gilde.inschrijffomulier.deelname-meerdere-wedstrijden.Verwijderen');

      // Junioren
      Route::get('/junioren/4', 'inschrijfformulierController@juniorenShow')->name('gilde.inschrijffomulier.junioren-&-leden-zonder-pas');

      // Links waardoor er geen naam en variabele toegevoegd hoeft te worden
      Route::get('/deelname/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.deelname');
      Route::get('/gildemis/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.gildemis');
      Route::get('/optocht/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.optocht');
      Route::get('/tentoonstelling/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.tentoonstelling');
      Route::get('/bazuinblazen/2', 'inschrijfformulierController@formShowTable')->name('gilde.inschrijffomulier.bazuinblazen');
      Route::get('/geweer/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.geweer');
      Route::get('/kruis-handboog/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.kruis-handboog');
      Route::get('/standaardrijden/1', 'inschrijfformulierController@formShowNormal')->name('gilde.inschrijffomulier.standaardrijden');
      Route::get('/trommen/2', 'inschrijfformulierController@formShowTable')->name('gilde.inschrijffomulier.trommen');
      Route::get('/vendelen/2', 'inschrijfformulierController@formShowTable')->name('gilde.inschrijffomulier.vendelen');
      //Route::get('/deelname-meerdere-wedstrijden/3', 'inschrijfformulierController@formDeelnameMeerdereWedstrijden')->name('gilde.inschrijffomulier.deelname-meerdere-wedstrijden');
    });
  });
});
