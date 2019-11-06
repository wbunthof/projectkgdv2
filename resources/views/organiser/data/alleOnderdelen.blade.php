{{--  #
      # Code van Wouter
      #
      # --}}

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
    //------------------------------------------------------------------------------------------------------------------------------------
    // Ingevulde vragen per onderdeel.
    @foreach ($formonderdelen as $onderdeel)
    @if (!($onderdeel->id == 12 || $onderdeel->id == 13))


    //column width
    width{{{$onderdeel->id}}} = document.getElementById('{{{$onderdeel->id}}}').offsetWidth


    var data{{{$onderdeel->id}}} = new google.visualization.DataTable();


    data{{{$onderdeel->id}}}.addColumn('number', 'Id');
    data{{{$onderdeel->id}}}.addColumn('string', 'Vraag');
    data{{{$onderdeel->id}}}.addColumn('string', 'Antwoord');
    data{{{$onderdeel->id}}}.addColumn('string', 'Eind deel');
    data{{{$onderdeel->id}}}.addRows([
      @foreach ($onderdeel->vraag as $vraag)
        [{{{$vraag->id}}},'{{{$vraag->tekst}}}', '@php
          if ($vraag->type == 'B') {
            $count = 0;
            foreach ($vraag->antwoord as $antwoord) {
              if ($antwoord->antwoord == 1) {
                $count++;
              }
            }
            echo $count . "', 'Aantal x ja ingevuld";
          } elseif ($vraag->type == 'N') {
            $count = 0;
            foreach ($vraag->antwoord as $antwoord) {
              $count = $count + $antwoord->antwoord;
            }
            echo $count . "', 'Totaal";
          } else {
            $count = 0;
            foreach ($vraag->antwoord as $antwoord) {
              $count++;
            }
            echo $count . "', 'Aantal x ingevuld";
          }
        @endphp'],
      @endforeach
    ]);

    data{{{$onderdeel->id}}}.setProperty(0, 0, 'style', 'width: ' + width{{{$onderdeel->id}}} * 0.05 + 'px');
    data{{{$onderdeel->id}}}.setProperty(0, 1, 'style', 'width: ' + width{{{$onderdeel->id}}} * 0.70 + 'px');
    data{{{$onderdeel->id}}}.setProperty(0, 2, 'style', 'width: ' + width{{{$onderdeel->id}}} * 0.05 + 'px');
    data{{{$onderdeel->id}}}.setProperty(0, 3, 'style', 'width: ' + width{{{$onderdeel->id}}} * 0.20 + 'px');

    // Set chart options
    var options{{{$onderdeel->id}}} = {'legend':'right',
                    'title':'Aantal vragen ingevuld per gilde',
                    allowHtml: true,
                  };

    // Instantiate and draw our chart, passing in some options.
    var table{{{$onderdeel->id}}} = new google.visualization.Table(document.getElementById('{{{$onderdeel->id}}}'));
    table{{{$onderdeel->id}}}.draw(data{{{$onderdeel->id}}}, options{{{$onderdeel->id}}});

    var linkVragen{{{$onderdeel->id}}} = [@foreach ($onderdeel->vraag as $vraag)'{{{route('organiser.data.vraag', ['ID' => $vraag->id])}}}',
    @endforeach];

    function selectHandler(e) {
      var selection{{{$onderdeel->id}}}  = table{{{$onderdeel->id}}}.getSelection();
      console.log(selection{{{$onderdeel->id}}});
      location.href = linkVragen{{{$onderdeel->id}}}[selection[0].row];
    }
    google.visualization.events.addListener(table{{{$onderdeel->id}}}, 'select', selectHandler);
    @endif
    @endforeach
  }

</script>
@endsection

@section('content')
    <div class="justify-content-center container-fluid">
      <h2>Alle onderdelen</h2>
      <hr style="border-width: 4px"> <br>
      <div class="container">
        @foreach ($formonderdelen as $onderdeel)
          <h3>{{{ucfirst($onderdeel->onderdeel)}}}</h3>
          <div id="{{{$onderdeel->id}}}"></div>
          <br>
        @endforeach
        <div id="test1"></div>
      </div>
    </div>
@endsection
