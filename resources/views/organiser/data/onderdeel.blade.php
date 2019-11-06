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
    var data = new google.visualization.DataTable();


    data.addColumn('number', 'Id');
    data.addColumn('string', 'Vraag');
    data.addColumn('string', 'Antwoord');
    data.addColumn('string', 'Eind deel');
    data.addRows([
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

    // Set chart options
    var options = {'legend':'right',
                    allowHtml: true,
                   'title':'Aantal vragen ingevuld per gilde',
                    'width': '100%'};

    // Instantiate and draw our chart, passing in some options.
    var table = new google.visualization.Table(document.getElementById('test1'));
    table.draw(data, options);

    var linkVragen = [@foreach ($onderdeel->vraag as $vraag)'{{{route('organiser.data.vraag', ['ID' => $vraag->id])}}}',
    @endforeach];

    function selectHandler(e) {
      var selection  = table.getSelection();
      console.log(selection);
      location.href = linkVragen[selection[0].row];
    }
    google.visualization.events.addListener(table, 'select', selectHandler);


    // Antwoorden per vraag

    @foreach ($onderdeel->vraag as $vraag)

    var dataVraag{{$vraag->id}} = new google.visualization.DataTable();


    dataVraag{{$vraag->id}}.addColumn('string', 'Gilde');
    dataVraag{{$vraag->id}}.addColumn('string', 'Antwoorden');
    dataVraag{{$vraag->id}}.addRows([
        @foreach ($vraag->antwoord as $antwoord)
          [`{{$antwoord->gilden->id}}
          {{$antwoord->gilden->name}}`,`
          @if ($vraag->type == 'B')
            @if ($antwoord->antwoord == 0)
              Nee <br>
            @elseif ($antwoord->antwoord == 1)
              Ja <br>
            @else
              {{$antwoord->antwoord}} <br>
            @endif
          @else
            {{$antwoord->antwoord}} <br>
          @endif`],
        @endforeach
      ]);
      {{--@foreach ($vraag->antwoord as $antwoord)
        {{$antwoord->gilden->id}}
        {{$antwoord->gilden->name}}
        @if ($vraag->type == 'B')
          @if ($antwoord->antwoord == 0)
            Nee <br>
          @elseif ($antwoord->antwoord == 1)
            Ja <br>
          @else
            {{$antwoord->antwoord}} <br>
          @endif
        @else
          {{$antwoord->antwoord}} <br>
        @endif
      @endforeach

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
      @endforeach--}}

    // Set chart options
    var optionsVraag{{$vraag->id}} = {'legend':'right',
                    allowHtml: true,
                   'title':'Aantal vragen ingevuld per gilde',
                    'width': '100%'};

    // Instantiate and draw our chart, passing in some options.
    var tableVraag{{$vraag->id}} = new google.visualization.Table(document.getElementById('Vraag{{$vraag->id}}'));
    tableVraag{{$vraag->id}}.draw(dataVraag{{$vraag->id}}, optionsVraag{{$vraag->id}});

    {{--var linkVragen = [@foreach ($onderdeel->vraag as $vraag)'{{{route('organiser.data.vraag', ['ID' => $vraag->id])}}}',
    @endforeach];--}}

    function selectHandler(e) {
      var selectionVraag{{$vraag->id}}  = tableVraag{{$vraag->id}}.getSelection();
      console.log(selectionVraag{{$vraag->id}});
      location.href = linkVragenVraag{{$vraag->id}}[selectionVraag{{$vraag->id}}[0].row];
    }
    google.visualization.events.addListener(tableVraag{{$vraag->id}}, 'select', selectHandler);
    @endforeach
  }

</script>
@endsection

@section('content')
    <div class="justify-content-center container-fluid">
      <h2>{{{ucfirst($onderdeel->onderdeel)}}}</h2>
      <hr style="border-width: 4px"> <br>
      <div class="container">
      <div id="test1"></div>
      <br>

      @foreach ($onderdeel->vraag as $vraag)
        <br>
        <h2>{{$vraag->tekst}}</h2>
        <div id="Vraag{{$vraag->id}}"></div>
      @endforeach
      {{--<h2>{{$vraag->tekst}}</h2>
        @foreach ($vraag->antwoord as $antwoord)
          {{$antwoord->gilden->id}}
          {{$antwoord->gilden->name}}
          @if ($vraag->type == 'B')
            @if ($antwoord->antwoord == 0)
              Nee <br>
            @elseif ($antwoord->antwoord == 1)
              Ja <br>
            @else
              {{$antwoord->antwoord}} <br>
            @endif
          @else
            {{$antwoord->antwoord}} <br>
          @endif
        @endforeach
      @php
      foreach ($onderdeel->vraag as $vraag) {
        dump($vraag);
      }
        dump($onderdeel);
      @endphp
    </div>
  </div> --}}
@endsection
