<!DOCTYPE html>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <title>Inschrijfformulier Kringgildedag</title>
  </head>
  <body>
    {!! Form::open(['url' => route('NieuwWachtwoordGildePOST'), 'method' => 'POST']) !!}
    {{ csrf_field() }}
    {!! Form::label('email', 'Vul hier het e-mailadres in waarvan u een nieuw wachtwoord wilt.', []) !!}
    {!! Form::text('email', '', []) !!}
    {!! Form::submit() !!}
    {!! Form::close() !!}
  </body>
</html>
