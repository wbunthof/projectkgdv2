@component('mail::message')

# Hallo {{ $user->name }},

De inschrijvingen voor de kringgildedag zijn weer geopend! <br>
Het project van afgelopen kringgildedag zijn doorgezet.<br>
Daarom zijn we nu naar een nieuw domein verhuist namelijk: kringgildedag.nl.<br>
<br>
Het wachtwoord van afgelopen jaar werkt nog steeds, mocht u het vergeten zijn kunt u op wachtwoord vergeten klikken op het inlogscherm.
@component('mail::button', ['url' => 'https://www.kringgildedag.nl'])
    Inloggen (www.kringgildedag.nl)
@endcomponent
U kunt inloggen op <a href="https://www.kringgildedag.nl/">www.kringgildedag.nl/</a><br>
<br>
Indien er vragen zijn aarzel niet om te mailen.
<a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a><br>
@endcomponent
