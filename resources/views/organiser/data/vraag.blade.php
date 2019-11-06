{{--  #
      # Code van Wouter
      #
      # --}}

@extends('organiser.layouts.app')
@section('ChartJS')
<script type="text/javascript">

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(function () {
      drawChart();
  });

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    //------------------------------------------------------------------------------------------------------------------------------------
    // Speciale antwoorden op nummervragen
    var dataNummer = new google.visualization.DataTable();
    dataNummer.addColumn('string', 'Type');
    dataNummer.addColumn('number', 'Antwoord');
    dataNummer.addRows([
      @if ($vraag->type == 'N' || $vraag->type == 'B')
      ['Totaal', {{{$vraag->antwoord->sum('antwoord')}}}],
      @endif
      @if ($vraag->type == 'N')
      ['Gemiddeld', {{{round($vraag->antwoord->avg('antwoord'), 1)}}}],
      @endif
      ['Gilden ingevuld', {{{$vraag->antwoord->count()}}}],
    ]);

    // Set chart options
    var optionsNummer = {'width' : '100%',
                          allowHtml: true,
                          };

    // Instantiate and draw our chart, passing in some options.
    var tableNummer = new google.visualization.Table(document.getElementById('Speciale antwoorden'));
    tableNummer.draw(dataNummer, optionsNummer);

    //------------------------------------------------------------------------------------------------------------------------------------
    // Antwoord op vraag per gilde
    @php($gildenIngevuld = [])
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Gilde');
    data.addColumn('string', 'Antwoord');
    data.addRows([
      @foreach ($vraag->antwoord as $antwoord)
        @if (!empty($antwoord->antwoord) || $antwoord->vraag->type == 'B')
        @php(array_push($gildenIngevuld, $antwoord->gilden->id))
          ['{{{$antwoord->gilden->id}}} {{{$antwoord->gilden->name}}}',
          @if ($antwoord->vraag->type == 'B')
            @if ($antwoord->antwoord == 1)
              'Ja'
            @elseif ($antwoord->antwoord == 0)
              'Nee'
            @else
              `{{{$antwoord->antwoord}}}`
            @endif
          @else
            `{{{$antwoord->antwoord}}}`
          @endif ],
        @endif
      @endforeach
    ]);

    // Set chart options
    var options = {'legend' : 'right',
                    allowHtml: true,
                   'title' : 'Aantal vragen ingevuld per gilde',
                    'width' : '100%',
                    'sortColumn' : '1'};

    // Instantiate and draw our chart, passing in some options.
    var table = new google.visualization.Table(document.getElementById('Gilden antwoorden'));
    table.draw(data, options);

    var linkGilde = [@foreach ($gildenIngevuld as $gilde)'{{{route('organiser.data.gilde', ['NBFS' => $gilde])}}}',
      @endforeach];

    function selectHandlerGilde(e) {
      var selection  = table.getSelection();
      console.log(selection);
      location.href = linkGilde[selection[0].row];
    }
    google.visualization.events.addListener(table, 'select', selectHandlerGilde);
  }

</script>
@endsection

@section('content')
    <div class="justify-content-center container-fluid">
      <h2>{{{$vraag->tekst}}}</h2>
      <hr style="border-width: 4px">
      <br>
      <div class="container">
        <div id="Speciale antwoorden"></div>
        <hr style="border-width: 2px">
        <br>
        <div id="Gilden antwoorden"></div>
      </div>
    </div>
@endsection
