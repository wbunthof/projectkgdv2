@component('mail::message')
# Hallo {{ $user->name }}

Uw bent e-mailadres is gewijzigd naar {{ $user->mail }} van het online inschrijfformulier.
U kunt dus niet meer inloggen.

Voor vragen neem contact op met het organiserend gilde op <a href="mailto:{{ setting('email organiserend gilde') }}">{{ setting('email organiserend gilde') }}</a>.

Bedankt voor het gebruik van de onlinedienst,<br>
{{ config('app.name') }}
@endcomponent
