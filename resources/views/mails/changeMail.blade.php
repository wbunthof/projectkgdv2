@component('mail::message')
# Hallo {{ $user->name }}

Uw bent e-mailadres is gewijzigd naar {{ $user->email }} van het online inschrijfformulier.
U kunt dus niet meer met het oude e-mailadres inloggen.

Voor vragen neem contact op <a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a>.

Bedankt voor het gebruik van de onlinedienst,<br>
{{ config('app.name') }}
@endcomponent
