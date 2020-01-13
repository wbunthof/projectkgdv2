Hallo {{ $user->name }},<br>
<br>
<br>
U heeft een nieuw wachtwoord aangevraagd of gekregen voor kringgildedag.nl.<br>
Hier is uw nieuwe wachtwoord:<br>
{{ $password }}<br>
<br>
Als e-mailadres heeft u:<br>
{{ $user->email }}<br>
<br>
@if($type === 'Gilde')
    U kunt inloggen op <a href="https://www.kringgildedag.nl/">www.kringgildedag.nl/</a><br>
@elseif($type === 'Raadsheer')
    U kunt inloggen op <a href="https://www.kringgildedag.nl/raadsheer/login">www.kringgildedag.nl/raadsheer/login</a><br>
@elseif($type === 'Admin')
    U kunt inloggen op <a href="https://www.kringgildedag.nl/admin/login">www.kringgildedag.nl/admin/login</a><br>
@elseif($type === 'Organiser')
    U kunt inloggen op <a href="https://www.kringgildedag.nl/organiser/login">www.kringgildedag.nl/organiser/login</a><br>
@endif
<br>
Het heeft geen zin om op deze mail te reageren. U kunt beter een bericht naar de secretaris van de kring sturen.<br>
<a href="mailto:secretariskringkempenland@gmail.com">secretariskringkempenland@gmail.com</a><br>
