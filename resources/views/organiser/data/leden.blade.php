@extends('organiser.layouts.app')
@section('ChartJS')
<script type="text/javascript">
  google.charts.setOnLoadCallback(function () {
      drawChart1();
  });

  function drawChart1(){
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'Id');
    data.addColumn('string', 'Naam');
    data.addColumn('string', 'Gilde');
    data.addColumn('string', 'Discipline');
    data.addColumn('string', 'Geboortedatum');

    data.addRows([
      @foreach ($leden as $lid)
        @php
          foreach ($kolommen[1] as $kolom) {
            $disciplineLid = "Niet bekend/ingevuld";
            if ($lid->$kolom == 1) {
              $disciplineLid = $kolom;
              break;
            }
          }
        @endphp


        [{{{$lid->leden->leden_id}}}, '{{{$lid->leden->voornaam . ' ' . $lid->leden->tussenvoegsel . ' ' . $lid->leden->achternaam}}}', '{{{$lid->gilde->name}}}', '{{{ucfirst($disciplineLid)}}}', '{{{$lid->leden->geboortedatum}}}'],
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
<h1>{{{ucfirst($discipline->discipline)}}}</h1>
{{-- @php (dump($kolommen)) --}}


<br><br>
<div id="table">

</div>
<br><br>
{{-- {{{time()}}} --}}

@endsection
