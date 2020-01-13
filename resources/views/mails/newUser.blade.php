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

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
