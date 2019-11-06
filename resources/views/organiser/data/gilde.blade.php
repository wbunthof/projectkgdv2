{{--  #
      # Code van Wouter
      #
      # --}}

@php($onderdeelId = 0)

@extends('organiser.layouts.app')
@section('ChartJS')
<script type="text/javascript">

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(function () {
      drawChart1();
  });

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart1() {
    @foreach ($vragenPerOnderdeel as $onderdeel)
    @php($vragenIds = [])
    //------------------------------------------------------------------------------------------------------------------------------------
    // Ingevulde vragen per onderdeel.
    var data = new google.visualization.DataTable();

    var width = document.getElementById('{{{str_replace(' ', '', $onderdeel[0])}}}').offsetWidth

    data.addColumn('string', 'Vraag');
    data.addColumn('string', 'Antwoord');
    data.addRows([
      @foreach ($onderdeel[1] as $antwoord)
        @if (!is_null($antwoord->vraag) && !is_null($antwoord->antwoord))

        @php(array_push($vragenIds, $antwoord->vraag->id))

          ['{{{$antwoord->vraag->id . ' ' . $antwoord->vraag->tekst}}}',
          @if ($antwoord->vraag->type == 'B')
            @if ($antwoord->antwoord == '0')
              'Nee'
            @elseif ($antwoord->antwoord == '1')
              'Ja'
            @endif
          @else
            '{{{preg_replace('/\s+/', ' ', trim($antwoord->antwoord))}}}'
          @endif],
        @endif
      @endforeach
      @if (count($vragenIds) < 1)
        ['Geen antwoorden', 'Geen antwoorden'],
      @endif
    ]);

    data.setProperty(0, 0, 'style', 'width: ' + width * 0.70 + 'px');
    data.setProperty(0, 1, 'style', 'width: ' + width * 0.30 + 'px');


    // Set chart options
    var options = {'legend':'right',
                   'title':'Aantal vragen ingevuld per gilde',
                    'width': '100%',
                    allowHtml: true};

    @php($onderdeelId++)

    // Instantiate and draw our chart, passing in some options.
    var table{{{$onderdeelId}}} = new google.visualization.Table(document.getElementById('{{{str_replace(' ', '', $onderdeel[0])}}}'));
    console.log(data.wg.length);
    if (data.wg.length != 0){
       table{{{$onderdeelId}}}.draw(data, options);
    }

    var linkVragen{{{$onderdeelId}}} = [@foreach ($vragenIds as $id)'{{{route('organiser.data.vraag', ['ID' => $id])}}}',
    @endforeach];

    function selectHandler{{{$onderdeelId}}}(e) {
      var selection{{{$onderdeelId}}}  = table{{{$onderdeelId}}}.getSelection();
      console.log(selection{{{$onderdeelId}}});
      location.href = linkVragen{{{$onderdeelId}}}[selection{{{$onderdeelId}}}[0].row];
    }

    google.visualization.events.addListener(table{{{$onderdeelId}}}, 'ready', function () {
        console.log(`document.getElementById('{{{str_replace(' ', '', $onderdeel[0])}}}').innerHTML = '<img src="' + table{{{$onderdeelId}}}.getImageURI() + '">';`);
        // console.log({{{str_replace(' ', '', $onderdeel[0])}}}.innerHTML);
      });


    google.visualization.events.addListener(table{{{$onderdeelId}}}, 'select', selectHandler{{{$onderdeelId}}});
    @endforeach
  }
</script>
@endsection

@section('content')
    <div class="justify-content-center container-fluid">
      <h1>{{{$gilde->name}}}</h1>
      <hr style="border-width: 4px"> <br>
      <div class="container">
      @foreach ($vragenPerOnderdeel as $onderdeel)
        <h2>{{ucfirst($onderdeel[0])}}</h2>
        <div class="container" id="{{{str_replace(' ', '', $onderdeel[0])}}}"></div>
        <br>
        <hr style="height: 2px">
      @endforeach

    </div>
    </div>
@endsection
