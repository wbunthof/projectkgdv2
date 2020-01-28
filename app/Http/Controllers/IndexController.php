<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Admin;
use App\Mail\newUser;
use App\Organiser;
use App\Raadsheer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Leden;
use App\Gilde;
use App\Repositories\GildeRepository;
use App\Services\GildeService;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;


class IndexController extends Controller
{
    public function index()
    {
      return view('auth.gilde-login');
    }

    public function test()
    {

        $vorige = Formonderdeel::where('id', '<', Formonderdeel::find(14)->id)->max('id');
        $volgende = Formonderdeel::where('id', '>', Formonderdeel::find(14)->id)->min('id');

        return dd($vorige, $volgende);



        $gilde = Raadsheer::first();
//        return str_replace('App\\', '', get_class($gilde));
       return `<script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^\${}()|\[\]\/\\])/g, idRx = /\bsf-dump-\d+-ref[012]\w+\b/, keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl', addEventListener = function (e, n, cb) { e.addEventListener(n, cb, false); }; (doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle); if (!doc.addEventListener) { addEventListener = function (element, eventName, callback) { element.attachEvent('on' + eventName, function (e) { e.preventDefault = function () {e.returnValue = false;}; e.target = e.srcElement; callback(e); }); }; } function toggle(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className, arrow, newClass; if (/\bsf-dump-compact\b/.test(oldClass)) { arrow = '&#9660;'; newClass = 'sf-dump-expanded'; } else if (/\bsf-dump-expanded\b/.test(oldClass)) { arrow = '&#9654;'; newClass = 'sf-dump-compact'; } else { return false; } if (doc.createEvent && s.dispatchEvent) { var event = doc.createEvent('Event'); event.initEvent('sf-dump-expanded' === newClass ? 'sfbeforedumpexpand' : 'sfbeforedumpcollapse', true, false); s.dispatchEvent(event); } a.lastChild.innerHTML = arrow; s.className = s.className.replace(/\bsf-dump-(compact|expanded)\b/, newClass); if (recursive) { try { a = s.querySelectorAll('.'+oldClass); for (s = 0; s < a.length; ++s) { if (-1 == a[s].className.indexOf(newClass)) { a[s].className = newClass; a[s].previousSibling.lastChild.innerHTML = arrow; } } } catch (e) { } } return true; }; function collapse(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-expanded\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function expand(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-compact\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function collapseAll(root) { var a = root.querySelector('a.sf-dump-toggle'); if (a) { collapse(a, true); expand(a); return true; } return false; } function reveal(node) { var previous, parents = []; while ((node = node.parentNode || {}) && (previous = node.previousSibling) && 'A' === previous.tagName) { parents.push(previous); } if (0 !== parents.length) { parents.forEach(function (parent) { expand(parent); }); return true; } return false; } function highlight(root, activeNode, nodes) { resetHighlightedNodes(root); Array.from(nodes||[]).forEach(function (node) { if (!/\bsf-dump-highlight\b/.test(node.className)) { node.className = node.className + ' sf-dump-highlight'; } }); if (!/\bsf-dump-highlight-active\b/.test(activeNode.className)) { activeNode.className = activeNode.className + ' sf-dump-highlight-active'; } } function resetHighlightedNodes(root) { Array.from(root.querySelectorAll('.sf-dump-str, .sf-dump-key, .sf-dump-public, .sf-dump-protected, .sf-dump-private')).forEach(function (strNode) { strNode.className = strNode.className.replace(/\bsf-dump-highlight\b/, ''); strNode.className = strNode.className.replace(/\bsf-dump-highlight-active\b/, ''); }); } return function (root, x) { root = doc.getElementById(root); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\$1')+')+', 'm'), options = {"maxDepth":1,"maxStringLength":160,"fileLinkFormat":false}, elt = root.getElementsByTagName('A'), len = elt.length, i = 0, s, h, t = []; while (i < len) t.push(elt[i++]); for (i in x) { options[i] = x[i]; } function a(e, f) { addEventListener(root, e, function (e, n) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } else { n = /\bsf-dump-ellipsis\b/.test(e.target.className) ? e.target.parentNode : e.target; if ((n = n.nextElementSibling) && 'A' == n.tagName) { if (!/\bsf-dump-toggle\b/.test(n.className)) { n = n.nextElementSibling || n; } f(n, e, true); } } }); }; function isCtrlKey(e) { return e.ctrlKey || e.metaKey; } function xpathString(str) { var parts = str.match(/[^'"]+|['"]/g).map(function (part) { if ("'" == part) { return '"\'"'; } if ('"' == part) { return "'\"'"; } return "'" + part + "'"; }); return "concat(" + parts.join(",") + ", '')"; } function xpathHasClass(className) { return "contains(concat(' ', normalize-space(@class), ' '), ' " + className +" ')"; } addEventListener(root, 'mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a, e, c) { if (c) { e.target.style.cursor = "pointer"; } else if (a = idRx.exec(a.className)) { try { refStyle.innerHTML = 'pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } catch (e) { } } }); a('click', function (a, e, c) { if (/\bsf-dump-toggle\b/.test(a.className)) { e.preventDefault(); if (!toggle(a, isCtrlKey(e))) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.paren`;
//        return dump($gilde);
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
