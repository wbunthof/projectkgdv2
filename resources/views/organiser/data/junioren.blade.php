@extends('organiser.layouts.app')
@section('ChartJS')
<script type="text/javascript">
  google.charts.setOnLoadCallback(function () {
      drawChart1();
  });

  function drawChart1(){
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Naam');
    data.addColumn('string', 'Disciplines');
    data.addColumn('string', 'Gilde');

    data.addRows([
      @foreach ($leden as $lid)
        [`{{{$lid->voornaam}}} {{{$lid->achternaam}}}`, `{{{'dump($lid)'}}}`, `{{{$lid->gilde->name}}}`],
      @endforeach
      ]);

    var table = new google.visualization.Table(document.getElementById('table'));

    var options = {
      allowHtml: true,
      width: '100%',
      height: '100%'
    }

    table.draw(data, options);
  };
</script>
@endsection

@section('content')
<h1>Junioren & leden zonder pas</h1>
{{-- @php (dump($kolommen)) --}}


<br><br>
<div id="table">

</div>
{{{dump($lid)}}}
<br><br>
{{-- {{{time()}}} --}}

@endsection
