<?php
//
// Begin code van Wouter
//

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\GildeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Admin;
//use App\Mail\NieuwGilde;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

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
        try {
            $this->adminService->update($request, Auth::id());
        } catch (Exception $e) {
            return back()->with('error' , 'Niet opgeslagen, probeer opnieuw!, Error: ' .  $e->getMessage());
        }

        return redirect(route('admin.account'))->with('succes', 'Gegevens geüpdate');
    }

//    public function gildenWeergevenDeprecated()
//    {
//      return view('admin.gilde')->with('gilden', $this->gildeservice->index());
//    }
//
//    public function gildenOpslaanNieuwDeprecated(Request $request)
//    {
//
//    $this->validate($request, [
//        'email'   => 'required|email|unique:Gilde',
//        'id'  => 'required|numeric|unique:Gilde,id',
//        'name'    => 'required|string',
//        'locatie' => 'required|string'
//    ]);
//
//    $this->gildeservice->create($request);
//
//    if (env('MAIL') == true) {
//        AdminController::mailFunctie($request->email, 'U bent aangemeld voor de kringgildedag',
//            ' <p>Beste ' . $gilde->name . ',</p>
//      <h3>
//        Inloggegevens
//      </h3>
//      <p>U bent aangemeld voor het nieuwe inscrhijffomulier voor de kringgildedag van Kring Kempenland op 2 juni. <a href="https://www.pure-air.nl/gilde/login">Klik hier om naar het inschrijformulier te gaan.</a><br> Daar kunt u inloggen met: <br>E-mailadres: ' . $gilde->email . '<br> Wachtwoord: ' . $request->password . '<br>
//        <u>Tip kopieer het wachtwoord!</u></p>
//
//      <h3>
//        Stappenplan
//      </h3>
//      <p>Nadat u bent ingelogd doet u het volgende:</p>
//      <ul>
//        <li>Klik op uw naam rechtsboven</li>
//        <li>Klik op account</li>
//        <li>Controleer alle gegevens</li>
//        <li>Klik op opslaan bij iedere wijziging</li>
//        <li>Klik op inschrijfformulier (de grote blauwe knop)</li>
//        <li>Vul het formulier in. <br>
//          <u>Tip alles wordt automatisch opgeslagen!</u></li>
//      </ul>
//      <p>
//        Door het formulier stap voor stap in te vullen doorloopt u het hele inschrijfformulier. Nadat u iets ingevuld heeft wordt het automatisch opgeslagen. Op het einde keert u terug naar het hoofdscherm. Door iets naar beneden te scrollen kunt u op het "Hoofdscherm"
//        per onderdeel zien wat u heeft ingevuld. Door op de vraag te klikken gaat u direct naar de vraag toe.
//      </p>
//
//      <h3>
//        Hoofdscherm
//      </h3>
//      <p>
//        Klik boven aan de pagina op "Hoofdscherm" als u naar het hoofdscherm wilt navigeren. <br> Onderaan het hoofdscherm zijn uw antwoorden bondig weergegeven. U kunt een vraag wijzigen door op de vraag zelf te klikken.
//      </p>
//
//      <h3>
//        Account
//      </h3>
//      <p>
//        Klik boven aan de pagina op "Account" als u uw persoonlijk/gildegegevens wilt wijzingen.
//      </p>
//
//      <h3>
//        Inschrijfformulier
//      </h3>
//      <p>
//        Om direct naar de onderdelen te gaan:
//        <ul>
//          <li>Deelname</li>
//          <li>Gildemis</li>
//          <li>Optocht</li>
//          <li>Tentoonstelling</li>
//          <li>Bazuinblazen</li>
//          <li>Geweer</li>
//          <li>Kruis- Handboog </li>
//          <li>Standaardrijden</li>
//          <li>Trommen</li>
//          <li>Vendelen</li>
//          <li>Junioren & leden zonder pas</li>
//          <li>Deelname meerdere wedstrijden</li>
//        </ul>
//        Ga dan boven op de pagina met uw muis op "Inschrijfformulier" staan en klik vervolgens op het onderdeel.
//      </p>
//
//
//      <h3> Indien u hulp nodig heeft mail dan naar onderstaand adres, met uw naam en telefoonnummer. Wij zullen spoedig contact opnemen.<br>
//      Disclaimer:<br> Door in te loggen en invullen van de digitale inschrijf omgeving verklaard het deelnemend gilde akkoord te gaan met het gebruik van haar gegevens en die van haar leden door het Heilig Kruisgilde Gerwen voor de organisatie van de
//      Kringgildedag 2019 te Gerwen.</h3>
//
//      <br><br>
//      <p>Met vriendelijke groet,<br>Wouter Bunthof,<br>Webmaster,<br>inschrijvenkgd2019@gmail.com</p>
//      ');
//    }
//
//    return back()->with('success', 'Gilde is toegevoegd met NBFS: ' . $request->nummer) . '.';
//
//
//    }
//
//    public function gildenVerwijderenDeprecated(Request $request)
//    {
//        if (env('MAIL') == true) {
//            AdminController::mailFunctie(
//            $this->gildeservice->read($request->id)->email,
//            'U bent verwijderd van het inscrhijffomulier voor de kringgildedag',
//            '<p> Beste ' . $gilde->name . ',</p>
//                    <p>U bent verwijderd van het inschrijfformulier voor de kringgildedag.
//                    U kun daardoor niet meer inloggen in de digitale omgeving.</p>
//
//                    <p>Dank voor uw deelname, <br>Wouter Bunthof,<br>Webdeveloper,<br>inschrijvenkgd2019@gmail.com</p>');
//        }
//
//        $this->gildeservice->delete($request->id);
//
//        return back()->with('error', 'Gilde met NBFS: ' . $request->id . ' is verwijderd.');
//    }
//
//    public function gildeNieuwWachtwoordAdminDeprecated(Request $request)
//    {
//        $this->validate($request, [
//            'id' => 'required|numeric'
//        ]);
//
//        return $this->gildeservice->newPassword($request->id);
//  }

//    static function mailFunctie($naar, $onderwerp, $bericht)
//  {
//    $message =
//
//    '<html>
//      <head><title>'. $onderwerp . '</title></head>
//      <body>
//        ' . $bericht . '
//      </body>
//    </html>';
//
//    $headers[] = 'MIME-Version: 1.0';
//    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
//
//    // Additional headers
//    $headers[] = 'From: Inschrijfformulier Kringgildedag <inschrijvenkgd@pure-air.nl>';
//    $headers[] = 'Return-Path: inschrijvenkgd@pure-air.nl';
//    $headers[] = 'X-sender: inschrijvenkgd@pure-air.nl';
//
//
//    // Mail it
//    mail($naar, $onderwerp, $message, implode("\r\n", $headers));
//  }
}

//
// Einde code van Wouter
//
