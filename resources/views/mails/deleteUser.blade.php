@component('mail::message')
# Hallo {{ $user->name }}

U bent verwijderd van het online inschrijfformulier.  
U kunt dus niet meer inloggen.

Voor vragen neem contact op <a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a>.


Bedankt voor het gebruik van de onlinedienst,<br>
{{ config('app.name') }}
@endcomponent
