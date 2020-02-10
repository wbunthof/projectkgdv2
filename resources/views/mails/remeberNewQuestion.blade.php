@component('mail::message')
# Hallo,

### Nieuwe vragen
Er zijn door de raadsheren nieuwe vragen toegevoegd bij de volgende onderdelen:  
@foreach($onderdelen as $onderdeel)
- <b>{{ $onderdeel }}</b>  
@endforeach

### Vragen
Indien er vragen over het functioneren van het formulier zijn aarzel niet om te mailen.
<a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a><br>

Indien er vragen zijn over de kringgildedag mail dan met {{ setting('naam organiserend gilde') }}.
<a href="mailto:{{ setting('email organiserend gilde') }}">{{ setting('email organiserend gilde') }}</a><br>
<br>

---

Bedankt voor het gebruik van de onlinedienst,<br>
{{ config('app.name') }}
@endcomponent
