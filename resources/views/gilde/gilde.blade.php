{{--  #
      # Code van Wouter
      #
      # --}}

@extends('gilde.layouts.app')

@section('content')
  <!-- Modal -->
  <div class="modal fade" id="hulpControleFormulier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Controle formulier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
        <div class="modal-body">
          {{-- <ul>
            <li>Door op een vraag te klikken gaat u naar deze vraag.</li>
          </ul> --}}
          <p>

          Achter de vraag staat het door u gegeven antwoord. <br>
          Door op de vraag te klikken kunt u het antwoord wijzigen.

          {{--
          Indien u dit antwoord wilt wijzigen kunt u op de

          Door op een vraag te klikken gaat u naar deze vraag. <br>
          Achter de vraag staat het door u gegeven antwoord. --}}
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sluiten</button>
        </div>
      </div>
    </div>
  </div>

    <div class="justify-content-center">
      <div class="alert alert-warning text-center" role="alert">
        <strong>Belangrijk!</strong> U kunt geen gegevens meer wijzigen. Mocht er iets dringends zijn verzoek ik u om een e-mail te sturen naar <a href="mailto:inschrijvenkgd2019@gmail.com">inschrijvenkgd2019@gmail.com</a>
        {{-- <strong>Belangrijk!</strong> Uw gegevens worden automatisch opgeslagen, daardoor kan het organiserend gilde meteen de gegevens inzien. Dit betekend dat u niks hoeft in te sturen dit gebeurt namelijk automatisch. --}}
      </div>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hallo, {{$gilde->name}}.</h1>
          <ul><li>Ik verzoek u om op <a href="{{route('gilde.account')}}">account</a> te klikken
            <ul>
              <li>Gegevens aan passen die foutief/niet ingevuld zijn.</li>
              <li><b>Elke keer</b> op opslaan te drukken.</li>
            </ul>

            </li><li>Hierna vraag ik u om op <a href="{{route('gilde.inschrijffomulier.deelname')}}">inschrijformulier</a> te klikken en dit te doorlopen. <br>
              <b>Als u iets intypt of een keuze maakt wordt het automatisch opgeslagen!</b>
            </li>

            <li>Bij vragen kunt u altijd een e-mail sturen naar <a href="mailto:inschrijvenkgd2019@gmail.com">inschrijvenkgd2019@gmail.com</a>.</li>



            <li>Hieronder staat alle ingevulde gegevens op een rijtje. U kunt de antwoorden van het onderdeel bekijken door op het onderdeel te klikken.</li>
          </ul>

          <a href="{{route('gilde.account')}}" class="btn btn-primary btn-block">Account</a>
        </div>
      </div>

      {{-- <div class="jumbotron">

        <h3>U bent ingelogd als .</h3>
        <ul><li>Ik verzoek u om op <a href="{{route('gilde.account')}}">account</a> te klikken
          <ul>
            <li>Gegevens aan passen die foutief/niet ingevuld zijn.</li>
            <li><b>Elke keer</b> op opslaan te drukken.</li>
          </ul>

          <li>Hierna vraag ik u om op <a href="{{route('gilde.inschrijffomulier.deelname')}}">inschrijformulier</a> te klikken en dit te doorlopen. <br>
            <b>Als u iets intypt of een keuze maakt wordt het automatisch opgeslagen!</b>
          </li>

          <li>Bij vragen kunt u altijd een e-mail sturen naar <a href="mailto:inschrijvenkgd2019@gmail.com">inschrijvenkgd2019@gmail.com</a>.</li>

          {{-- <li>U kunt hier altijd weer terug komen door linksboven op Kringgildedag te klikken.</li> --}}

          {{--<li>Hieronder staat alle ingevulde gegevens op een rijtje. U kunt de antwoorden van het onderdeel bekijken door op het onderdeel te klikken.</li>
        </ul>

        <a href="{{route('gilde.account')}}" class="btn btn-primary btn-block">Account</a>
        <a href="#"></a>


      </div> --}}

      {{-- <div class="container">
        <div class="row">
          @foreach ($dataVragen as $onderdeel)
            <div class="col-md-6">
              <h2>{{{ucfirst($onderdeel[0])}}}</h2>
              @if (isset($onderdeel[1][0]))
              @foreach ($onderdeel[1] as $vraag)
                <a href="{{route('gilde.inschrijffomulier.' . $onderdeel[0]) . '#' . $vraag->vraag->id}}">
                  {{$vraag->vraag->tekst}}</a>
                  <b><span class="float-right">
                    @if ($vraag->vraag->type == 'B')
                      @if ($vraag->antwoord == 1)
                        Ja
                      @elseif ($vraag->antwoord == 0)
                        Nee
                      @endif
                    @else
                      {{$vraag->antwoord}}
                    @endif
                  </span></b><br>
              @endforeach
              @else
                <b>Geen antwoorden voor deze discipline gegeven.</b>
              @endif
              <p>@if ($onderdeel[0] == 'groep') <a class="btn btn-secondary" href="{{route('gilde.inschrijffomulier.vendelen')}}">Vendelen »</a> <a class="btn btn-secondary" href="{{route('gilde.inschrijffomulier.trommen')}}">Trommen »</a> <a class="btn btn-secondary" href="{{route('gilde.inschrijffomulier.bazuinblazen')}}">Bazuinblazen »</a>  @else<a class="btn btn-secondary" href="{{route('gilde.inschrijffomulier.' . $onderdeel[0])}}" role="button">Naar vragen »</a>@endif</p>
            </div>
          @endforeach
        </div>
      </div> --}}

      <div class="accordion container" id="accordion">
        <div class="card">
          <div class="card-header text-center bg-warning"><h1 class="display-4">Controle formulier @if (is_null($antwoordenId)) (Nog geen vragen beantwoord) @endif
            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#hulpControleFormulier">
              Extra uitleg
            </button></h1>
          </div>
        </div>

        {{-- @if (!count($vragen) == 0)
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Niet ingevulde vragen (klik op de vragen om deze te openen en alsnog in te vullen).
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <ul>

              @foreach ($vragen as $vraag)

                @if (!in_array($vraag->id, $antwoordenId))
                  <li><a href="{{route('gilde.inschrijffomulier.' . $vraag->formonderdeel) . '#' . $vraag->id}}">
                    {{$vraag->tekst}}
                  </a>
                  <br></li>
                @endif
              @endforeach
            </ul>
            </div>
          </div>
        </div>
      @endif --}}
@if (!is_null($antwoordenId))
@foreach ($dataVragen as $onderdeel)


  {{--  Hotfix omdat 'groep' geen $onderdeel[0] heeft en tijdelijk hier toegewezen krijgt--}}
  <div class="card">
    <div class="card-header" id="heading{{{$onderdeel[0]}}}">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{{$onderdeel[0]}}}" aria-expanded="true" aria-controls="collapse{{{$onderdeel[0]}}}">
          <h4><b>{{{ucfirst($onderdeel[0])}}}</b></h4>
        </button>
      </h5>
    </div>

    <div id="collapse{{{$onderdeel[0]}}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
          @if (isset($onderdeel[1][0]))
          @foreach ($onderdeel[1] as $vraag)
            <a href="{{route('gilde.inschrijffomulier.' . $onderdeel[0]) . '#' . $vraag->vraag->id}}">
              {{$vraag->vraag->tekst}}</a>
              <b><span class="float-right">
                @if ($vraag->vraag->type == 'B')
                  @if ($vraag->antwoord == 1)
                    Ja
                  @elseif ($vraag->antwoord == 0)
                    Nee
                  @endif
                @else
                  {{$vraag->antwoord}}
                @endif
              </span></b><br>
          @endforeach
          @else
            <b>Geen antwoorden voor deze discipline gegeven.</b>
          @endif
      </div>
    </div>
  </div>
@endforeach

  <div class="card">
    <div class="card-header" id="headingGroepen">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseGroepen" aria-expanded="true" aria-controls="collapseGroepen">
          <h4><b>Groepen</b></h4>
        </button>
      </h5>
    </div>

    <div id="collapseGroepen" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
          @foreach ($dataGroepen as $onderdeel)
            <h5><b>{{{ucfirst($onderdeel[0])}}}</b></h5>
            @if ($onderdeel[1]->count() == 0)
              Geen antwoorden gegeven bij het groeps{{{$onderdeel[0]}}}
            @endif
            @foreach ($onderdeel[1] as $vraag)
              <a href="{{route('gilde.inschrijffomulier.' . $onderdeel[0]) . '#' . $vraag->vraag->id}}">
                {{$vraag->vraag->tekst}}</a>
                <b><span class="float-right">
                  @if ($vraag->vraag->type == 'B')
                    @if ($vraag->antwoord == 1)
                      Ja
                    @elseif ($vraag->antwoord == 0)
                      Nee
                    @endif
                  @else
                    {{$vraag->antwoord}}
                  @endif
                </span></b><br>
            @endforeach
            <br>
          @endforeach
      </div>
    </div>
  </div>



@foreach ($dataLeden as $formulieronderdeel)
  <div class="card">
    <div class="card-header" id="heading{{{$formulieronderdeel[0]}}}">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{{$formulieronderdeel[0]}}}" aria-expanded="true" aria-controls="collapse{{{$formulieronderdeel[0]}}}">
          <h4><b>{{{ucfirst($formulieronderdeel[0])}}}</b></h4>
        </button>
      </h5>
    </div>

    <div id="collapse{{{$formulieronderdeel[0]}}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        @if (isset($formulieronderdeel[1][0]))
        @foreach ($formulieronderdeel[1] as $lid)
          {{{$lid->leden->voornaam}}}
          {{{$lid->leden->tussenvoegsel}}}
          {{{$lid->leden->achternaam}}}
          @foreach ($formulieronderdeel[2] as $kolom)
            @if ($lid->$kolom == 1)
              <b><span class="float-sm-right">{{ucfirst($kolom)}}</span></b>
            @endif
          @endforeach
          <br>
        @endforeach
        @else
          <b>Geen leden bij het {{{$formulieronderdeel[0]}}}</b>
        @endif
      </div>
    </div>
  </div>
@endforeach

{{-- DeelnameMeerdereWedstrijden --}}
<div class="card">
  <div class="card-header" id="headingDeelnameMeerdereWedstrijden">
    <h5 class="mb-0">
      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDeelnameMeerdereWedstrijden" aria-expanded="true" aria-controls="collapseDeelnameMeerdereWedstrijden">
        <h4><b>Deelname Meerdere Wedstrijden</b></h4>
      </button>
    </h5>
  </div>

  <div id="collapseDeelnameMeerdereWedstrijden" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
      @if ($dataDeelnameMeedereWedstrijden->count() > 0)
      @foreach ($dataDeelnameMeedereWedstrijden as $lid)
        {{{$lid->naam}}}
        <b><span class="float-sm-right">{{{$lid->disciplines}}}</span></b>
        <br>
      @endforeach
      @else
      <b>Geen leden die deelnemen aan meerdere wedstrijden toegevoegd</b>
    @endif
    </div>
  </div>
</div>

 {{-- Junioren  --}}
<div class="card">
  <div class="card-header" id="headingJunioren">
    <h5 class="mb-0">
      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseJunioren" aria-expanded="true" aria-controls="collapseJunioren">
        <h4><b>Junioren en leden zonder pas</b></h4>
      </button>
    </h5>
  </div>

  <div id="collapseJunioren" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
      @if ($dataJunioren->count() > 0)
      @foreach ($dataJunioren as $lid)
        {{{$lid->voornaam}}}
        {{{$lid->achternaam}}}
        <b><span class="float-sm-right">{{{$lid->JuniorenDiscipline->klasse}}}</span></b>
        <br>
      @endforeach
      @else
        <b>Geen leden & junioren zonder pas toegevoegd</b>
      @endif
    </div>
  </div>
</div>
@endif

</div>
</div>
@endsection
