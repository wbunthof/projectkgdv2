<!DOCTYPE html>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <title>Inschrijfformulier Kringgildedag</title>
  </head>
  <body>
    {!! Form::open() !!}
    {{ csrf_field() }}
    {!! Form::label('E-mailadres', 'Vul hier het e-mailadres in waarvan u een nieuw wachtwoord wilt.', []) !!}
    {!! Form::text('E-mailadres', '', []) !!}
    {!! Form::close() !!}
  </body>
</html>
