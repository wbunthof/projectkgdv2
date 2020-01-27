@component('mail::message')
# Hallo {{ $user->name }},

U bent toegevoegd als {{ $type }}.<br><br>
Met als e-mailadres: <br>
**{{ $user->email }}** <br>
Uw wachtwoord:<br>
**{{ $password }}** <br>

@if($type === 'Gilde')
@component('mail::button', ['url' => 'https://www.kringgildedag.nl/'])
    Inloggen
@endcomponent


@elseif($type === 'Raadsheer')
@component('mail::button', ['url' => 'https://www.kringgildedag.nl/raadsheer/login/'])
    Inloggen
@endcomponent

Let op! De link om in te loggen is <a href="https://www.kringgildedag.nl/raadsheer/login">www.kringgildedag.nl/raadsheer/login</a>.

U heeft machtigingen tot de/het volgende onderde(e)l(en):<br>
    @foreach($user->formOnderdelen as $onderdeel)
    <a href="{{ route('raadsheer.onderdeel', ['id' => $onderdeel->id]) }}">{{ ucfirst($onderdeel->onderdeel) }}</a><br>
    @endforeach
<br>
    
U kunt hier:<br>
- Vragen toevoegen/bewerken/deactiveren (later weer te activeren)/definitief verwijderen, <br>
- Leden toevoegen/bewerken/verwijderen en <br>
- Disciplines toevoegen/bewerken/verwijderen.
    
@elseif($type === 'Admin')
@component('mail::button', ['url' => 'https://www.kringgildedag.nl/admin/login/'])
    Inloggen
@endcomponent

Let op! De link om in te loggen is <a href="https://www.kringgildedag.nl/admin/login">www.kringgildedag.nl/admin/login</a>.


@elseif($type === 'Organiser')
@component('mail::button', ['url' => 'https://www.kringgildedag.nl/organiser/login/'])
    Inloggen
@endcomponent

Let op! De link om in te loggen is <a href="https://www.kringgildedag.nl/organiser/login">www.kringgildedag.nl/organiser/login</a>.
@endif
Bij onduidelijkheden over de website mail naar: website@kringgildedag.nl<br>
<br>
<br>
Bedankt,<br>
{{ config('app.name') }}<br>
<br>
PS. Disclaimer:<br> Door in te loggen en invullen van de digitale inschrijf omgeving verklaard het deelnemend gilde akkoord te gaan met het gebruik van haar gegevens en die van haar leden door het {{ setting('naam organiserend gilde') }} voor de organisatie van de
Kringgildedag {{ setting('datum kringgildedag') }} te {{ setting('locatie kringgildedag') }}.
@endcomponent
