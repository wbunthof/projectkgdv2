<?php
//
// Begin code van Wouter
//

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Gilde;
use App\Raadsheer;
use App\Organiser;
use Illuminate\Support\Facades\Mail;
use App\Mail\NieuwGilde;

class AdminController extends Controller
{
  public function index()
  {
      return view('admin.dashboard');
  }

  public function account()
  {
    return view('admin.account');
  }

  public function accountUpdate(Request $request)
  {
    //update gebruikergegevens
    $user = Admin::find($request->id);
    $tempOnderdeel = $request->onderdeel;
    $user->$tempOnderdeel = $request->waarde;
    $user->save();

    return redirect('admin/account')->with('success', 'Gegevens opgeslagen');
  }

  public function gildenWeergeven()
  {
    $gilden = Gilde::all();
    return view('admin.gilde')->with('gilden', $gilden);
  }

  public function gildenOpslaanNieuw(Request $request)
  {

    $request->password = str_random(8);
    $this->validate($request, [
      'email'   => 'required|email|unique:Gilde',
      'nummer'  => 'required|numeric|unique:Gilde,id',
      'naam'    => 'required|string'
    ]);

    $gilde = new Gilde;
    $gilde->id = $request->nummer;
    $gilde->name = $request->naam;
    $gilde->email = $request->email;
    if (isset($request->locatie)) {
      $gilde->locatie = $request->locatie;
    }
    $gilde->password = Hash::make($request->password);
    $gilde->save();

    AdminController::mailFunctie($request->email, 'U bent aangemeld voor de kringgildedag',
    ' <p>Beste ' . $gilde->name . ',</p>
      <h3>
        Inloggegevens
      </h3>
      <p>U bent aangemeld voor het nieuwe inscrhijffomulier voor de kringgildedag van Kring Kempenland op 2 juni. <a href="https://www.pure-air.nl/gilde/login">Klik hier om naar het inschrijformulier te gaan.</a><br> Daar kunt u inloggen met: <br>E-mailadres: ' . $gilde->email . '<br> Wachtwoord: ' . $request->password . '<br>
        <u>Tip kopieer het wachtwoord!</u></p>

      <h3>
        Stappenplan
      </h3>
      <p>Nadat u bent ingelogd doet u het volgende:</p>
      <ul>
        <li>Klik op uw naam rechtsboven</li>
        <li>Klik op account</li>
        <li>Controleer alle gegevens</li>
        <li>Klik op opslaan bij iedere wijziging</li>
        <li>Klik op inschrijfformulier (de grote blauwe knop)</li>
        <li>Vul het formulier in. <br>
          <u>Tip alles wordt automatisch opgeslagen!</u></li>
      </ul>
      <p>
        Door het formulier stap voor stap in te vullen doorloopt u het hele inschrijfformulier. Nadat u iets ingevuld heeft wordt het automatisch opgeslagen. Op het einde keert u terug naar het hoofdscherm. Door iets naar beneden te scrollen kunt u op het "Hoofdscherm"
        per onderdeel zien wat u heeft ingevuld. Door op de vraag te klikken gaat u direct naar de vraag toe.
      </p>

      <h3>
        Hoofdscherm
      </h3>
      <p>
        Klik boven aan de pagina op "Hoofdscherm" als u naar het hoofdscherm wilt navigeren. <br> Onderaan het hoofdscherm zijn uw antwoorden bondig weergegeven. U kunt een vraag wijzigen door op de vraag zelf te klikken.
      </p>

      <h3>
        Account
      </h3>
      <p>
        Klik boven aan de pagina op "Account" als u uw persoonlijk/gildegegevens wilt wijzingen.
      </p>

      <h3>
        Inschrijfformulier
      </h3>
      <p>
        Om direct naar de onderdelen te gaan:
        <ul>
          <li>Deelname</li>
          <li>Gildemis</li>
          <li>Optocht</li>
          <li>Tentoonstelling</li>
          <li>Bazuinblazen</li>
          <li>Geweer</li>
          <li>Kruis- Handboog </li>
          <li>Standaardrijden</li>
          <li>Trommen</li>
          <li>Vendelen</li>
          <li>Junioren & leden zonder pas</li>
          <li>Deelname meerdere wedstrijden</li>
        </ul>
        Ga dan boven op de pagina met uw muis op "Inschrijfformulier" staan en klik vervolgens op het onderdeel.
      </p>


      <h3> Indien u hulp nodig heeft mail dan naar onderstaand adres, met uw naam en telefoonnummer. Wij zullen spoedig contact opnemen.<br>
      Disclaimer:<br> Door in te loggen en invullen van de digitale inschrijf omgeving verklaard het deelnemend gilde akkoord te gaan met het gebruik van haar gegevens en die van haar leden door het Heilig Kruisgilde Gerwen voor de organisatie van de
      Kringgildedag 2019 te Gerwen.</h3>

      <br><br>
      <p>Met vriendelijke groet,<br>Wouter Bunthof,<br>Webmaster,<br>inschrijvenkgd2019@gmail.com</p>
      ');

    return back()->with('success', 'Gilde is toegevoegd met NBFS: ' . $request->nummer) . '.';


  }

  public function gildenVerwijderen(Request $request)
  {
    $tablesVerwijderenNBFS_id = array(
      'bazuinblazen',
      'DeelnameMeerdereWedstrijden',
      'junioren',
      'trommen',
      'vendelen');
    $tablesVerwijderenNBFS = array(
      'deelname',
      'geweer',
      'gildemis',
      'groep',
      'Kruis-handboog',
      'optocht',
      'standaardrijden',
      'tentoonstelling');
    foreach ($tablesVerwijderenNBFS_id as $tabel) {
      DB::table($tabel)->where('NBFS_id', $request->id)->delete();
    }
    foreach ($tablesVerwijderenNBFS as $tabel) {
      DB::table($tabel)->where('NBFS', $request->id)->delete();
    }

    DB::table('antwoorden')->where('NBFS', $request->id)->delete();

    $gilde = Gilde::find($request->id)->first();
    Gilde::find($request->id)->delete();

    AdminController::mailFunctie($gilde->email, 'U bent verwijderd van het inscrhijffomulier voor de kringgildedag',
    '<p> Beste ' .$gilde->name. ',</p>
    <p>U bent verwijderd van het inschrijfformulier voor de kringgildedag.
    U kun daardoor niet meer inloggen in de digitale omgeving.</p>

    <p>Dank voor uw deelname, <br>Wouter Bunthof,<br>Webdeveloper,<br>inschrijvenkgd2019@gmail.com</p>');

    return back()->with('error', 'Gilde met NBFS: ' . $request->id . ' is verwijderd.');
  }

  public function gildeNieuwWachtwoordAdmin(Request $request)
  {
    return AdminController::gildeNieuwWachtwoord($request->id);
  }

  static function gildeNieuwWachtwoord($id)
  {
    $password = str_random(8);
    $gilde = Gilde::where('id', $id)->first();
    $gilde->password = Hash::make($password);
    $gilde->save();

    $to_name = $gilde->name;
    $to_email = $gilde->email;
    $data = array('gilde'=>$gilde);

    // Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
    //     $message->to($to_email, $to_name)
    //             ->subject('Artisans Web Testing Mail');
    //     $message->from('info@pure-air.nl','Inschrijven Kringgildedag');
    // });

    AdminController::mailFunctie($gilde->email, 'Uw nieuwe wachtwoord voor het aanmeldingsformulier van de kringgildedag',
    ' <p>Beste ' . $gilde->name . ',</p>
      <h3>
        Inloggegevens
      </h3>
      <p>U bent aangemeld voor het nieuwe inscrhijffomulier voor de kringgildedag van Kring Kempenland op 2 juni. <a href="https://www.pure-air.nl/gilde/login">Klik hier om naar het inschrijformulier te gaan.</a><br> Daar kunt u inloggen met: <br>E-mailadres: ' . $gilde->email . '<br> Wachtwoord: ' . $password . '<br>
        <u>Tip kopieer het wachtwoord!</u></p>

      <h3>
        Stappenplan
      </h3>
      <p>Nadat u bent ingelogd doet u het volgende:</p>
      <ul>
        <li>Klik op uw naam rechtsboven</li>
        <li>Klik op account</li>
        <li>Controleer alle gegevens</li>
        <li>Klik op opslaan bij iedere wijziging</li>
        <li>Klik op inschrijfformulier (de grote blauwe knop)</li>
        <li>Vul het formulier in. <br>
          <u>Tip alles wordt automatisch opgeslagen!</u></li>
      </ul>
      <p>
        Door het formulier stap voor stap in te vullen doorloopt u het hele inschrijfformulier. Nadat u iets ingevuld heeft wordt het automatisch opgeslagen. Op het einde keert u terug naar het hoofdscherm. Door iets naar beneden te scrollen kunt u op het "Hoofdscherm"
        per onderdeel zien wat u heeft ingevuld. Door op de vraag te klikken gaat u direct naar de vraag toe.
      </p>

      <h3>
        Hoofdscherm
      </h3>
      <p>
        Klik boven aan de pagina op "Hoofdscherm" als u naar het hoofdscherm wilt navigeren. <br> Onderaan het hoofdscherm zijn uw antwoorden bondig weergegeven. U kunt een vraag wijzigen door op de vraag zelf te klikken.
      </p>

      <h3>
        Account
      </h3>
      <p>
        Klik boven aan de pagina op "Account" als u uw persoonlijk/gildegegevens wilt wijzingen.
      </p>

      <h3>
        Inschrijfformulier
      </h3>
      <p>
        Om direct naar de onderdelen te gaan:
        <ul>
          <li>Deelname</li>
          <li>Gildemis</li>
          <li>Optocht</li>
          <li>Tentoonstelling</li>
          <li>Bazuinblazen</li>
          <li>Geweer</li>
          <li>Kruis- Handboog </li>
          <li>Standaardrijden</li>
          <li>Trommen</li>
          <li>Vendelen</li>
          <li>Junioren & leden zonder pas</li>
          <li>Deelname meerdere wedstrijden</li>
        </ul>
        Ga dan boven op de pagina met uw muis op "Inschrijfformulier" staan en klik vervolgens op het onderdeel.
      </p>


      <h3> Indien u hulp nodig heeft mail dan naar onderstaand adres, met uw naam en telefoonnummer. Wij zullen spoedig contact opnemen.<br>
      Disclaimer:<br> Door in te loggen en invullen van de digitale inschrijf omgeving verklaard het deelnemend gilde akkoord te gaan met het gebruik van haar gegevens en die van haar leden door het Heilig Kruisgilde Gerwen voor de organisatie van de
      Kringgildedag 2019 te Gerwen.</h3>

      <br><br>
      <p>Met vriendelijke groet,<br>Wouter Bunthof,<br>Webmaster,<br>inschrijvenkgd2019@gmail.com</p>
      ');

    return back()->with('success', 'Gilde met NBFS ' . $gilde->id . ' heeft een nieuw wachtwoord ontvangen.') . '.';
  }

  static function mailFunctie($naar, $onderwerp, $bericht)
  {
    $message =

    '<html>
      <head><title>'. $onderwerp . '</title></head>
      <body>
        ' . $bericht . '
      </body>
    </html>';

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Additional headers
    $headers[] = 'From: Inschrijfformulier Kringgildedag <inschrijvenkgd@pure-air.nl>';
    $headers[] = 'Return-Path: inschrijvenkgd@pure-air.nl';
    $headers[] = 'X-sender: inschrijvenkgd@pure-air.nl';


    // Mail it
    mail($naar, $onderwerp, $message, implode("\r\n", $headers));
  }
}

//
// Einde code van Wouter
//
