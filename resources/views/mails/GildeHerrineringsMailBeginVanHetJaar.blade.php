@component('mail::message')
![Banner][logo]

[logo]: {{asset('/img/Banner.jpg')}} "Banner KGD 2020"

# Hallo {{ $user->name }},

De inschrijvingen voor de kringgildedag zijn weer geopend! <br>
### Deadline
De deadline voor het inschrijven is: {{ Carbon\Carbon::parse(setting('Uiterste inlever datum'))->format('j M Y') }} <br>

### Nieuw domein
Het project van afgelopen kringgildedag voor de inschrijvingen is doorgezet.<br>
Daarom zijn we nu naar een nieuw domein verhuist namelijk: **kringgildedag.nl**.<br>
<br>

### Wachtwoord
Het wachtwoord van afgelopen jaar werkt nog steeds, mocht u het vergeten zijn kunt u op wachtwoord vergeten klikken op het inlogscherm.
@component('mail::button', ['url' => 'https://www.kringgildedag.nl'])
    Inloggen (www.kringgildedag.nl)
@endcomponent
<br>

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
