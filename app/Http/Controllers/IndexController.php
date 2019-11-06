<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Leden;
use App\Vraag;
use App\Mail\testMail;
use App\Gilde;
use App\Antwoord;
use App\Bazuinblazen;
use App\Trommen;
use App\Vendelen;
use App\Formonderdeel;
use App\Discipline;
use App\Deelnamemeerderewedstrijden;
use App\Junioren;


class IndexController extends Controller
{
    public function index()
    {
      return view('auth.gilde-login');
    }

    public function test()
    {
      return dump(DB::table('beamer')->select('gegevens')->get());
    }

      public function nietIngevuld()
      {
        $gilden = Gilde::all();
        $nietIngevulGilden = [];

        foreach ($gilden as $gilde) {
          if ($gilde->antwoorden->count() == 0 && $gilde->name != "Heilig Kruisgilde Gerwen" && $gilde->id != 0)
          {
            array_push($nietIngevulGilden, $gilde->name);
          }
        }


      return dump($nietIngevulGilden);
    }

    public function ajax($type, $input, $discpline) //Request $request
    {
      if ($type == 0) {
        $data = Leden::select('leden_id', 'voorletter', 'achternaam')->where("leden_id","LIKE","%{$input}%")->where('discipline_id', '=', $discpline)->limit(5)->get();
      } elseif ($type == 1) {
        $data = Leden::select('leden_id', 'voorletter', 'achternaam')->where("voornaam","LIKE","%{$input}%")->where('discipline_id', '=', $discpline)->limit(5)->get();
      } elseif ($type == 2) {
        $data = Leden::select('leden_id', 'voorletter', 'achternaam')->where("achternaam","LIKE","%{$input}%")->where('discipline_id', '=', $discpline)->limit(5)->get();
      }
    // return response()->json($data);
    return view('raden')->with('data', $data);
  }

  // public function mail()
  // {
  //   Mail::to('o9420976@nwytg.net')->send(new testMail);
  //   return time();
  // }

  public function disclaimer()
  {
    return '<h2>DISCLAIMER</h2>
            <p>De webmaster heeft veel zorg besteedt aan deze website. De informatie die via de website wordt verstrekt, is in principe afkomstig van betrouwbare bronnen.</p>
            <p>Toch kan de webmaster noch de juistheid, noch de volledigheid, of de geschiktheid van informatie voor welk gebruik dan ook garanderen. Informatie wordt zonder welke garantie dan ook verschaft. Aan de inhoud van de site kunnen tegenover de webmaster dan ook geen rechten worden ontleend.<br />De gebruiker wordt ervoor gewaarschuwd dat de verstrekte informatie periodiek, zonder aankondiging, kan worden gewijzigd.</p>
            <p>De webmaster is niet verantwoordelijk voor om het even welk initiatief dat de gebruiker op basis van de verstrekte informatie neemt.</p>
            <p>De webmaster sluit elke aansprakelijkheid uit voor eventuele directe, indirecte, incidentele schade of om het even welke andere schade die het gevolg zou zijn van, zou voortvloeien uit, of verband zou houden met het gebruik van de website van de webmaster of met de onmogelijkheid deze te gebruiken.</p>
            <p>De webmaster is op geen enkele wijze aansprakelijk voor eventuele storingen, fouten of onderbrekingen in de elektronische publicatie van de website en verwante informatiediensten.</p>
            <p>Indien u denkt dat informatie op deze internetsite onjuist is, dan verzoeken wij u vriendelijk dit te melden bij de <a href="mailto:inschrijvenkgd2019@gmail.com">Webmaster</a>.</p>
            <p>&nbsp;</p>

            <h2>PRIVACY POLICY VAN DE WEBSITE VOOR HET INSCHRIJVEN VOOR DE KRINGGILDE DAG VAN KRINGKEMPENLAND</h2>
            <p>Deze privacyverklaring vormt een nadere uitwerking in het kader van de Algemene Verordening Gegevensbescherming. Deze privacyverklaring omschrijft welke persoonsgegevens het organiserend gilde verwerkt en voor welke doeleinden deze persoonsgegevens worden gebruikt.</p>
            <p>1. GEBRUIK VAN PERSOONSGEGEVENS</p>
            <p>1.1 Het organiserend gilde verwerkt (mogelijk) hierna genoemde persoonsgegevens van u indien u:<br />a. akkoord aan uw gilde hebt gegeven om uw gegevens aan ons te verstrekken; <br />b. zich inschrijft / aanmeldt als deelnemend gilde van de kringgildedag; <br />c. zich aanmeld als raadsheer;<br />d. zich aanmeld als admin;<br />e. zich aanmeld als organiserend gilde.</p>
            <p>1.2&nbsp;Het organiserend gilde verzamelt of heeft verkregen d.m.v raadsheren en/of andere bronnen (mogelijk) de volgende (persoons)gegevens: <br />a. voorletters en naam; <br />b. geboortedatum; <br />c. adres; <br />d. e-mailadres; <br />e. telefoonnummer; <br />f. leeftijd; <br />g. geslacht; <br />h. BSN-nummer (in het geval van een bestuursfunctie); <br />i. en voorts mogelijk relevante gegevens (zoals commissie- en vrijwilligersfunctie(s) binnen de NBFS; <br />j. browsercookies.</p>
            <p>1.3&nbsp;Het organiserend gilde kan deze gegevens gebruiken om:<br />a. de organisatie van de kringgildedag; <br />b. uitvoeren/aansturen van activiteiten; <br />c. het verstrekken van de gepersonaliseerde documenten; <br />d. beleidsinformatie (beleidsformulering en optimalisering dienstverlening); <br />e. voorlichting (informatievoorziening);&nbsp;<br />f. onderzoek (ontwikkeling in het gildewezen); <br />g. handhaving;<br />h. optimalisaties zoeken en/of doorvoeren in de organisatie van de kringgildedag;<br />i.&nbsp; optimalisaties zoeken&nbsp;en/of doorvoeren voor het gildenwezen.</p>
            <p>2. INFORMATIE, WIJZIGING EN BEZWAAR <br />U kunt contact opnemen met de het organiserend gilde via e-mail inschrijvenkgd2019@gmail.com voor:</p>
            <p>a. meer informatie over de wijze waarop persoonsgegevens verwerkt worden;</p>
            <p>b. vragen naar aanleiding van deze privacyverklaring;</p>
            <p>c. inzage in de persoonsgegevens die met betrekking tot u verwerkt worden;</p>
            <p>d. bezwaar tegen het gebruik van uw gegevens.</p>
            <p>3. BEVEILIGING VAN UW GEGEVENS</p>
            <p>3.1 Het organiserend gilde zal uw gegevens uitsluitend gebruiken voor de in deze privacyverklaring genoemde doeleinden en ze niet langer bewaren dan noodzakelijk is.</p>
            <p>3.2&nbsp;Het organiserend gilde treft adequate technische en organisatorische maatregelen om uw gegevens te beveiligen.</p>
            <p>4. DERDEN</p>
            <p>4.1&nbsp;Het organiserend gilde kan uw gegevens aan de volgende derden verstrekken: <br /> E&eacute;n of meerdere van de zes Gildekringen die aangesloten zijn bij de Noord-brabantse federatie schuttersgilden; <br /> Koepel Nederlandse Traditionele Schutters; <br /> Stichting De Gildetrom; <br /> Verwerkers voor het organiserend gilde (voor de uitvoering van de dienstverlening);<br /> Data-verwerkers voor het organiserend gilde&nbsp;(voor de uitvoering van de dienstverlening);<br /> Personen en/of instaties die zich bezig houden met verbeteren van de veiligheid;<br /> Wouter Bunthof (originele ontwerper van de website);<br /> Personen en/of instanties die zich bezighouden met de controle en handhaving van de vigerende wet- en regelgeving.</p>
            <p>4.2 Uw gegevens worden niet verstrekt aan andere derden dan genoemd in artikel 4.1. tenzij u daarvoor uitdrukkelijk toestemming heeft gegeven of&nbsp;het organiserend gilde daartoe verplicht is op grond van de wet of een rechterlijke uitspraak.</p>
            <p>5. WIJZIGINGEN Het kan voorkomen dat deze privacyverklaring in de toekomst wordt gewijzigd. Wij raden daarom aan om deze privacyverklaring geregeld te raadplegen.</p>';
  }

}

//
// Einde code van Wouter
//
