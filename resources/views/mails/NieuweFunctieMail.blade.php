@component('mail::message')
![Banner][logo]

[logo]: {{asset('/img/Banner.jpg')}} "Banner KGD 2020"

# Hallo {{ $user->name }},
<br><br>

## Automatisch opslaan
Omdat er nog steeds onduidelijkheid is over het versturen/opslaan van het formulier hierbij nogmaals de uitleg.
Zodra u antwoord geeft wordt dit automatisch naar onze servers (dit zijn computers die voor ons de gegevens opslaan) gestuurd.
U krijgt dan een melding bovenaan de pagina te zijn met Opgeslagen o.i.d..<br>
U kunt dit controleren door naar het volgende onderdeel van het formulier te gaan en vervolgens weer terug.
Als u namelijk een deel van het formulier opent worden de gegevens die eerder zijn opgeslagen van de server gehaald.
En op uw scherm getoond dooor middel van het juiste antwoord.

#### Voorbeeld:
U vult het aantal leden die deelnemen aan de optocht in bij het onderdeel "Deelname".<br>
Dan klikt u bijvoorbeeld op 'nee' bij de vraag "Zijn daarbij leden met een scootmobiel?".<br>
Achter de schermen worden uw antwoorden op de servers opgeslagen.<br>
Dit kunt u herkennen aan de groene meldingen bovenaan de website die zeggen "Succesvol opgeslagen".<br>
Dan zijn de gegevens bij ons bekend en opgeslagen.<br>

Dit betekend dus dat u niks hoeft in te leveren.<br>
Zodra de einddatum is verstreken halen de raadsheren de gegevens die u heeft ingevuld en automatisch zijn opgeslagen van de servers, en worden ze verwerkt om een mooie kringdag te organiseren!<br>
<br><br>

## Downloaden en printen
Omdat veel gilden het wensten om een kopie van het formulier te kunnen krijgen.<br>
Is deze functionaliteit op kortere termijn toegevoegd.<br>
Zodra u inlogt is er een knop waarop staat "Download en print gegevens".<br>
![alt text]( {{asset('/img/downloadButton1.png')}} "Download Button 1 Excel")
Als u vervolgens nogmaals op downloaden klikt krijgt u een kopie van de gegevens zoals ingevuld door en dus bekend bij ons.<br>
![alt text]( {{asset('/img/downloadButton2.png')}} "Download Button 2 Excel")
U kunt dit bestand indien gewenst ook uitprinten.<br>
<b>let op, aanpassingen dienen altijd op de website gedaan te worden.<br>
Aanpassingen in het excel bestand worden niet meegenomen bij het organiseren van de kringgildedag.</b><br>
<br><br>


## Vragen
Indien er vragen over het functioneren van het formulier zijn aarzel niet om te mailen.<br>
<a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a><br><br>

Indien er vragen zijn over de kringgildedag mail dan met {{ setting('naam organiserend gilde') }}.<br>
<a href="mailto:{{ setting('email organiserend gilde') }}">{{ setting('email organiserend gilde') }}</a><br>
<br>

---

Bedankt voor het gebruik van de onlinedienst,<br>
{{ config('app.name') }}
@endcomponent
