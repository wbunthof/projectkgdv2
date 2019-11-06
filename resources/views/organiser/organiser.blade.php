{{--  #
      # Code van Wouter
      #
      # --}}

@extends('organiser.layouts.app')
@php($aantalGilden = 0)
@section('ChartJS')
<script type="text/javascript">

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(function () {
      drawchart();
  });

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.

  function drawchart() {

    //------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------
      // Ingevulde vragen per gilde grafiek met kolommen met aantal vragen beantwoord en lijn met threshold.
      var data = new google.visualization.DataTable();

      // array met links naar de pagina's van de gilden
      var linkGilde = [@foreach ($gilden as $gilde)'{{{route('organiser.data.gilde', ['NBFS' => $gilde->id])}}}',
        @endforeach];

      // Hier wordt de threshold van 60% uitgerekend
      var threshold = {{{$vragen->count() * 0.6}}};

      // Grafiek opties, extra te vinden op https://developers.google.com/chart
      var options = { legend:'right',
                      title:'Aantal vragen ingevuld per gilde, gilden: {{{$gilden->count()}}} vragen: {{{$vragen->count()}}}',
                      height: 750,
                      seriesType: 'bars',
                      series: {0 : {type: 'line'}}};

      // Grafiek aangeven + div aangeven waar de chart in moet komen te staan
      var chartGilde = new google.visualization.ComboChart(document.getElementById('Aantal vragen per gilde Column'));

      // 3 kolommen met naam van het gilde, threshold, aantal vragen ingevuld
      data.addColumn('string', 'Gilden');
      data.addColumn('number', '60% voltooid');
      data.addColumn('number', 'Vragen ingevuld');

      // Rijen met de data van de gilden
      // [naam gilde, threshold, aantal vragen]
      data.addRows([
        @foreach ($gilden as $gilde)
        {{-- @php($aantalGilden = 0)
          ['{{{$gilde->id . ' ' . $gilde->name}}}', threshold, {{{$gilde->antwoorden->count}}}]
          @php ($var = 0)--}}
          ['{{{$gilde->id . ' ' . $gilde->name}}}', threshold, {{{$gilde->antwoorden->count()}}}],
        @endforeach
      ]);

      // Voeg data grafiek in + options
      chartGilde.draw(data, options);

      // Grafiek select eventlistner met doorverwijzing naar pagina
      // (var linkOnderdeel gedeclareerd bij data van deze grafiek)
      function selectHandlerGilde(e) {
        var selection  = chartGilde.getSelection();
        console.log(selection);
        location.href = linkGilde[selection[0].row];
      }
      google.visualization.events.addListener(chartGilde, 'select', selectHandlerGilde);




    //------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------
    // Ingevulde disciplines per gilde.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Gilden');
    data.addColumn('number', 'Vendeliers');
    data.addColumn('number', 'Tamboers');
    data.addColumn('number', 'Bazuinblazers');
    data.addColumn('number', 'Junioren & leden zonder pas');
    data.addColumn('number', 'Deelname meerdere wedstrijden');
    data.addRows([
      @foreach ($gilden as $gilde)
      ['{{{$gilde->id . ' ' . $gilde->name}}}', {{{$gilde->vendelen->count()}}}, {{{$gilde->trommen->count()}}}, {{{$gilde->bazuinblazen->count()}}}, {{{$gilde->junioren->count()}}}, {{{$gilde->deelnamMeerdereWedstrijden->count()}}}],
        @if ($gilde->antwoorden->count() > 0)
          @php($aantalGilden++)
        @endif
      @endforeach
    ]);

    // Set chart options
    var options = {legend:'right',
                   title:'Aantal leden toegevoegd per gilde',
                   height: 750,
                   seriesType: 'bars',}

    // Instantiate and draw our chart, passing in some options.
    var chartGildeDisciplines = new google.visualization.ComboChart(document.getElementById('Aantal vragen per gilde disciplines Column'));
    chartGildeDisciplines.draw(data, options);

    // Column chart select eventlistner met doorverwijzing naar pagina
    // (var linkOnderdeel gedeclareerd bij data van deze chart)
    function selectHandler(e) {
      var selection  = chartGildeDisciplines.getSelection();
      location.href = linkGilde[selection[0].row];
      console.log(linkGilde[selection[0].row]);
    }
    google.visualization.events.addListener(chartGildeDisciplines, 'select', selectHandler);



    //------------------------------------------------------------------------------------------------------------------------------------
    // Percentage gildes klaar (60%).
    @php($gildenIngevuldThreshold = 0)
    @php($gildenIngevuldIets = 0)

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Gilden');
    data.addColumn('number', 'Vragen ingevuld');
    data.addRows([
      @foreach ($gilden as $gilde)
        @if ($gilde->antwoorden->count()/$vragen->count() > 0.6)
          @php($gildenIngevuldThreshold++)
        @elseif ($gilde->antwoorden->count()/$vragen->count() > 0)
          @php($gildenIngevuldIets++)
        @endif
      @endforeach
      ['Ingevuld, aantal: {{{$gildenIngevuldThreshold}}}', {{{($gildenIngevuldThreshold/$gilden->count())*100}}}],
      ['Niet genoeg ingevuld, aantal: {{{$gildenIngevuldIets}}}', {{{($gildenIngevuldIets/$gilden->count())*100}}}],
      ['Niets ingevuld, aantal: {{{$gilden->count() - $gildenIngevuldThreshold - $gildenIngevuldIets}}}', {{{(1 - (($gildenIngevuldThreshold+$gildenIngevuldIets)/$gilden->count()))*100}}}],
    ]);

    // Set chart options
    var options = {'legend':'right',
                   'title':'Percentage gilden ingevulde vragen(meer dan 60%), totaal: {{{$gilden->count()}}}',
                   'height': 400};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('Percentage gilden ingevulde vragen Pie'));
    chart.draw(data, options);

    //------------------------------------------------------------------------------------------------------------------------------------
    //Per onderdeel
    var data = new google.visualization.DataTable();
    var linkOnderdeel = [@foreach ($formonderdelen as $onderdeel)
      '{{{route('organiser.data.onderdeel', ['ID' => $onderdeel->id])}}}',
      @endforeach];
    data.addColumn('string', 'Onderdeel');
    data.addColumn('number', 'Vragen ');
    data.addRows([
      @foreach ($formonderdelen as $onderdeel)
        ['{!!ucfirst($onderdeel->onderdeel)!!}', {{{$onderdeel->vraag->count()}}}],
      @endforeach
    ]);

    // Set chart options
    var options = {'legend':'rigth',
                   'title':'Aantal vragen per onderdeel',
                   'height':400};

    var chartOnderdeelColumn = new google.visualization.ColumnChart(document.getElementById('Vragen per onderdeel Column'));
    chartOnderdeelColumn.draw(data, options);

    // Column chart select eventlistner met doorverwijzing naar pagina
    // (var linkOnderdeel gedeclareerd bij data van deze chart)
    function selectHandlerOnderdeelColumn(e) {
      var selection  = chartOnderdeelColumn.getSelection();
      location.href = linkOnderdeel[selection[0].row];
      console.log(linkOnderdeel[selection[0].row]);
    }
    google.visualization.events.addListener(chartOnderdeelColumn, 'select', selectHandlerOnderdeelColumn);

    // Pie chart select eventlistner met doorverwijzing naar pagina
    // (var linkOnderdeel gedeclareerd bij data van deze chart)
    var chartOnderdeelPie = new google.visualization.PieChart(document.getElementById('Vragen per onderdeel Pie'));
    chartOnderdeelPie.draw(data, options);

    function selectHandlerOnderdeelPie(e) {
      var selection  = chartOnderdeelPie.getSelection();
      location.href = linkOnderdeel[selection[0].row];
      console.log(linkOnderdeel[selection[0].row]);
    }
    google.visualization.events.addListener(chartOnderdeelPie, 'select', selectHandlerOnderdeelPie);
  }

  // window.addEventListener("resize", drawchart());
</script>
@endsection

@section('content')
    <div class="justify-content-center container-fluid">
      <h1>Aantal vragen ingevuld per Gilde</h1>
      <div id="Percentage gilden ingevulde vragen Pie"></div>
      <div id="Aantal vragen per gilde Column"></div>
      <div id="Aantal vragen per gilde disciplines Column"></div>

      <h1>Aantal vragen ingevuld per Gilde</h1>
      <div id="Vragen per onderdeel Column"></div>
      <div id="Vragen per onderdeel Pie"></div>
    </div>
@endsection
