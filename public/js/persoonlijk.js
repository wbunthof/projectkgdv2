//
// Begin code van Wouter
//

 /* Personal Code 2.4.3 ~ Wouter Bunthof
  * The code that's normally not provided belongs mainly to Wouter Bunthof. And is not meant for distribution, without clear approvement of the owner.
  * The code that doesn't belong to Wouter Bunthof has markings, or can be asked about at wbunthof@gmail.com.
  * The whole list of sources is available through contact with the e-mailadres that has been implied before.

  https://jscompress.com/
  */


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function myFunction() {
  if(window.location.hash) {
    var el = document.getElementById(window.location.hash.substring(1)); //Puts hash in variable, and removes the # character
    el.classList.add = "bg-info";
    console.log(el);
  }
}

myFunction();

// reload wanneer pagina bekeken wordt vanuit history
if (performance.navigation.type == 2) {
   location.reload(true);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Controleerd of er een geldig nummer wordt ingevoerd en geeft een reactie als er een fout word gemaakt
function nummerChecker(el, melding) {
  // Waarde ingevoerd?
  if (el.value) {
    el.value = el.value.replace(/\D+/g, "");

    // Waarde buiten min/max?
    if (el.max) {
      if (Number(el.value) > Number(el.max) || Number(el.value) < Number(el.min)) {
        el.classList.add('is-invalid');
        el.dataset.fout = "true";

        // Bestaat modal?
        if (el.parentNode.children.length == 3) {

          // Toggle modal
          $('#errorModal'+el.name).modal('toggle');

          // Maak input leeg
          el.value = '';

          // Focus terug naar input
          el.focus();

        } else {
          // Maak modal
          div = document.createElement('DIV');
          el.parentNode.appendChild(div);
          div.id = 'modalParent' + el.name;
          div.innerHTML = '<div class="modal" id="errorModal'+el.name+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"> <h3>U kunt een waarde van maximaal: '+el.max+' invullen.</h3> <button type="button" class="btn btn-block btn-secondary float-right" data-dismiss="modal">Sluiten</button></div></div></div></div>';

          // Toggle modal
          $('#errorModal'+el.name).modal('toggle');

          // Maak input leeg
          el.value = '';

          // Focus terug naar input
          el.focus();
        }
      } else {
        el.classList.remove('is-invalid');
        el.dataset.fout = "false";
      }
    }
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Verwijderen van element
function verwijderElement(modalId) {
  var element = document.getElementById(modalId);
  element.parentNode.removeChild(element);

}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Opslaan van nummer velden
function vraagOpslaanNummer(el, url, token) {
  if (Number(el.value) >= Number(el.min) && Number(el.value) <= Number(el.max) && el.dataset.fout != "true") {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)	{
        console.log(xmlhttp.response);
      }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

    // verzend de data
    xmlhttp.send("waarde=" + el.value + "&vraag_id=" + el.name + "&_token=" + token);
  } else if (!el.max || !el.min){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)	{
        console.log(xmlhttp.response);
      }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

    // verzend de data
    xmlhttp.send("waarde=" + el.value + "&vraag_id=" + el.name + "&_token=" + token);
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Opslaan van text velden
function vraagOpslaanText(el, url, token) {

      //if (Number(el.value.length) >= Number(el.minLength) && Number(el.value.length) <= Number(el.maxLength)) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)	{
            console.log(xmlhttp.response);
          }
        };
      xmlhttp.open("POST", url, true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

      // verzend de data
      xmlhttp.send("waarde=" + el.value + "&vraag_id=" + el.name + "&_token=" + token);
    //}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Opslaan van ja/nee vragen
function vraagOpslaanBoolean(el, url, token) {
      // if (el.value == 1 || el.value == 0) {

        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)	{
            console.log(xmlhttp.response);
          }
        };
      xmlhttp.open("POST", url, true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

      // verzend de data
      xmlhttp.send("waarde=" + el.value + "&vraag_id=" + el.name + "&_token=" + token);
      console.log('waarde = ' + el.value);
    // }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cross-browser solution for adding classes (for IE9)
// Code from https://www.w3schools.com/howto/howto_js_add_class.asp
function classToevoegen(el, clas) {
  var arr;
  arr = el.className.split(" ");
  if (arr.indexOf(clas) == -1) {
    el.className += " " + clas;
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cross-browser solution for adding classes (for IE9)
// Code from https://www.w3schools.com/howto/howto_js_remove_class.asp
function classVerwijderen(el, clas) {
  regex = "/\b",clas,"\b/g";
  // console.log(regex);
  el.className = el.className.replace(regex, "");
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functie voor het opzoeken van leden in het leden tabel
function LidOpzoeken(type, str, discipline, url) {
  // type (zoeken op):      0 = id
  //                        1 = voornaam
  //                        2 = achternaam
  //----------------------------------------------------------------------------
  // str: waarde waarop gezocht wordt
  //----------------------------------------------------------------------------
  // discipline: bazuinblazen of trommen of vendelen
  // voluit geschreven
  //----------------------------------------------------------------------------

  switch (discipline.toLowerCase().trim()) {
    case 'bazuinblazen':
      discipline = 0;
      break;
    case 'trommen':
      discipline = 1;
      break;
    case 'vendelen':
      discipline = 2;
      break;
  }

  if (str.length != 0) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)	{
        document.getElementById("tabelVoorLeden").innerHTML = xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET", url + "/gilde/inschrijffomulier/lidopzoeken/" + type +"/" + str + "/" + discipline, true);
    console.log(url + "/gilde/inschrijffomulier/lidopzoeken/" + type +"/" + str + "/" + discipline);
    xmlhttp.send();
  } else {
    document.getElementById("23").innerHTML = '';
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Voor formulieronderdeel Bazuinblazen, Trommen en Vendelen
// Wanneer er op een van de resultaten van het tabel wordt geklikt wordt het in de inputs gezet.
function inputsVullen(elem) {
  document.getElementById('id').value = elem.getElementsByClassName('id')[0].innerHTML;
  document.getElementById('voornaam').value = elem.getElementsByClassName('voorletter')[0].innerHTML;
  document.getElementById('achternaam').value = elem.getElementsByClassName('achternaam')[0].innerHTML;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functie om deelname in database op te slaan
// Dit is een speciale button en wordt niet standaard gegenereerd
function deelname(keuze, vraag_id, nbfs, token, url) { // 0 = nee; 1 = ja
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200)	{

        el1 = document.getElementById("vraag1.1");
        el0 = document.getElementById("vraag1.0");

				if (keuze == 1) {
					document.getElementById("alertOpslaan").innerHTML = '<div class="alert alert-success" role="alert">Deelname is opgeslagen!</div>';
          el1.className = "btn btn-primary mr-1 mb-2 active";
          el1.innerHTML = "Ja (gekozen)";
          el0.className = "btn btn-primary mr-1 mb-2"
          el0.innerHTML = "Nee";
					} else if (keuze == 0) {
					document.getElementById("alertOpslaan").innerHTML = '<div class="alert alert-success" role="alert">Geen deelname is opgeslagen!</div>';
          el1.className = "btn btn-primary mr-1 mb-2";
          el1.innerHTML = "Ja";
          el0.className = "btn btn-primary mr-1 mb-2 active"
          el0.innerHTML = "Nee  (gekozen)";
				}
			}
		};
    xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

		//verzend de data
		xmlhttp.send("keuze=" + keuze + "&NBFS=" + nbfs  + "&vraag_id=" + vraag_id + "&_token=" + token);
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functie voor het updaten van disciplines van leden in de formulieronderdelen Bazuinblazen, Trommen en Vendelen
function lidUpdatenInschrijfformulier(id, discipline, route, csrf){
  //Start and send AJAX
  xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", route, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //altijd hetzeflde

  //verzend de data
  xmlhttp.send("id=" + id + "&discipline=" + encodeURIComponent(discipline) + "&_token=" + csrf);
  console.log(encodeURIComponent(discipline));


  //als er een statusverandering is opgetreden doe:
  //bij status: 4, 200 is het laden verzonden en gelukt
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)	{
      console.log(xmlhttp.responseText);
      if (xmlhttp.responseText == 'succes'){
        document.getElementById("messages").innerHTML = '<div class="alert alert-success alert-dismissible">Discipline geüpdate<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
      }
    }
  };
}



// ONGEBRUIKT ONGEBRUIKT ONGEBRUIKT ONGEBRUIKT ONGEBRUIKT ONGEBRUIKT ONGEBRUIKT

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Was een functie bedoelt om bij account, wanneer er op een element (in dit geval eigen gegevens) geklikt werd deze om te zetten naar een input
function ToInput (oorspronkelijkElement, classHtml, id) {
  var d = document.createElement('form');
  d.value = oorspronkelijkElement.innerHTML.trim();
  d.className = classHtml;
  d.id = id;
  var1.parentNode.replaceChild(d, classHtml);
}
