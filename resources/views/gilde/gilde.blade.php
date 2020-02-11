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
              <div class="modal-body">
                  <p>
                      Achter de vraag staat het door u gegeven antwoord. <br>
                      Door op de vraag te klikken kunt u het antwoord wijzigen.
                  </p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sluiten</button>
              </div>
          </div>
      </div>
  </div>
  <div class="justify-content-center">
      {{--    <div class="alert alert-warning text-center" role="alert">--}}
      {{--        <strong>Belangrijk!</strong> U kunt geen gegevens meer wijzigen. Mocht er iets dringends zijn verzoek ik u om een e-mail te sturen naar <a href="mailto:inschrijvenkgd2019@gmail.com">inschrijvenkgd2019@gmail.com</a>--}}
      {{--        --}}{{-- <strong>Belangrijk!</strong> Uw gegevens worden automatisch opgeslagen, daardoor kan het organiserend gilde meteen de gegevens inzien. Dit betekend dat u niks hoeft in te sturen dit gebeurt namelijk automatisch. --}}
      {{--    </div>--}}
      <div class="jumbotron">
          <div class="container">
              <h1 class="display-3">Hallo, {{$gilde->name}}.</h1>
              @include('includes.countdown', ['element' => 'countdown', 'time' => setting('Uiterste inlever datum')])
              <h2>Nog zolang kunt u inschrijven: <div id="countdown"></div></h2>
              <ul>
                  <li>
                      Ik verzoek u om op <a href="{{route('gilde.account')}}">account</a> te klikken
                      <ul>
                          <li>Gegevens aan passen die foutief/niet ingevuld zijn.</li>
                          <li><b>Elke keer</b> op opslaan te drukken.</li>
                      </ul>
                  </li>
                  <li>
                      Hierna vraag ik u om op <a href="{{route('gilde.inschrijfformulier', ['formonderdeel' => 1])}}">inschrijformulier</a> te klikken en dit te doorlopen. <br>
                      <b>Als u iets intypt of een keuze maakt wordt het automatisch opgeslagen!</b>
                  </li>
                  <li>
                      Bij vragen kunt u altijd een e-mail sturen naar <a href="mailto:website@kringgildedag.nl">website@kringgildedag.nl</a> of <a href="mailto:{{ setting('email organiserend gilde') }}">{{ setting('email organiserend gilde') }}</a>.
                  </li>
                  <li>
                      Hieronder staat alle ingevulde gegevens op een rijtje. U kunt de antwoorden van het onderdeel bekijken door op het onderdeel te klikken.
                  </li>
            </ul>
              <a href="{{route('gilde.account')}}" class="btn btn-primary btn-block">Account</a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#downloadUitleg">
                  Download en print gegevens
              </button>

              <!-- Modal -->
              <div class="modal" id="downloadUitleg" tabindex="-1" role="dialog" aria-labelledby="downloadUitlegLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="downloadUitlegLabel">Download gegevens</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <ul>
                                  <li>
                                      U kunt door op de onderstaande knop te klikken de gegevens die bij ons zijn opgeslagen downloaden. Dit is een excel bestand, u kunt deze dan eventueel ook uitprinten.
                                  </li>
                                  <li>
                                      <b>Alle wijzigingen die u aanbrengt in het excelbestand worden niet bij ons opgeslagen. 
                                          En zullen dus niet mee worden genomen bij het organiseren van de kringgildedag.<br></b>
                                  </li>
                                  <li>    
                                      <b>
                                          Dit bestand is puur ter referentie!</b>
                                  </li>
                              </ul>
                              <a href="{{route('gilde.download.all', ['id' => Auth::id()])}}" class="btn btn-primary btn-block" download>Download gegevens</a>
                          </div>
                      </div>
                  </div>
              </div>
                
        </div>
    </div>
        
    <div class="accordion container" id="accordion">
        <div class="card">
            <div class="card-header text-center bg-warning">
                <h1 class="display-4">Controle formulier @if (is_null($antwoordenId)) (Nog geen vragen beantwoord) @endif
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#hulpControleFormulier">
                        Extra uitleg
                    </button>
                </h1>
            </div>
        </div>

        @foreach ($onderdelen as $onderdeel)
  <div class="card">
      <div class="card-header" id="heading{{ $onderdeel->onderdeel }}">
          <h5 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $onderdeel->onderdeel }}" aria-expanded="true" aria-controls="collapse{{ $onderdeel->onderdeel }}">
                  <h4><b>{{ ucfirst($onderdeel->onderdeel) }}</b></h4>
              </button>
          </h5>
      </div>
      <div id="collapse{{ $onderdeel->onderdeel }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
              @if($onderdeel->vraag->count())
                  @forelse ($onderdeel->antwoorden()->with('vraag')->where('NBFS', Auth::id())->get() as $antwoord)
                      <a href="{{route('gilde.inschrijfformulier', ['id' => $onderdeel->id]) . '#' . $antwoord->vraag->id}}">
                          {{$antwoord->vraag->tekst}}
                      </a>
                      <b><span class="float-right">
                              @if ($antwoord->vraag->type == 'boolean')
                                  @if ($antwoord->antwoord == 1)
                                      Ja
                                  @elseif ($antwoord->antwoord == 0)
                                      Nee
                                  @endif
                              @else
                                  {{$antwoord->antwoord}}
                              @endif
                      </span></b>
                      <br>
                  @empty
                      <b>Geen antwoorden voor deze discipline gegeven.</b>
                  @endforelse
              @endif
              
              <br>
                  
              @if($onderdeel->leden)
                  @forelse($onderdeel->leden()->with('discipline')->where('gilde_id', Auth::id())->get() as $lid)
                      {{$lid->voornaam}}
                      {{$lid->tussenvoegsel}}
                      {{$lid->achternaam}}
                      <b><span class="float-sm-right">{{ucfirst($lid->discipline ? $lid->discipline->naam : "Verwijderd of onbeschikbare discipline")}}</span></b>
                      <br>
                  @empty
                      <b>Geen leden bij het {{ $onderdeel->onderdeel }}</b>
                  @endforelse
              @endif
                  
              <br>
                  
              @if ($onderdeel->meerderewedstrijden)
                  @forelse ($deelnameMeerdereWedstrijden as $lid)
                      
                      {{ $lid->naam }}
                      <b><span class="float-sm-right">{{$lid->disciplines}}</span></b>
                      <br>
                  @empty
                      <b>Geen leden die deelnemen aan meerdere wedstrijden toegevoegd</b>
                  @endforelse
              @endif
              
              <br>
                  
              @if($onderdeel->junioren)
                  @forelse ($junioren as $lid)
                      {{ $lid->voornaam }} {{ $lid->achternaam }}
                      <b><span class="float-sm-right">{{ $lid->discipline ? $lid->discipline->naam : "Verwijderd of onbeschikbare discipline"}}</span></b>
                      <br>
                  @empty
                      <b>Geen leden geen pas hebben toegevoegd</b>
                  @endforelse
              @endif
          
      </div>
    </div>
  </div>
@endforeach

    </div>
</div>
@endsection
