{{--  #
      # Code van Wouter
      #
      # --}}

@extends('raadsheer.layouts.app')

@section('content')
<div class="container">
    @if(setting('Raadsheren nog vragen aanpassen melding?') == 1)
        <div class="alert alert-warning text-center" role="alert">
            <strong>Opletten!</strong> De gilden zijn de vragen aan het invullen, veranderingen kunnen dus door gilden die al klaar zijn niet meer opgemerkt worden.
        </div>
    @endif
        <div class="alert alert-danger text-center" role="alert">
            <strong>Opletten!</strong> Nog niet alle gilden hebben ingevuld, de informatie is dus mogelijk nog incompleet. Hier wordt actie op ondernomen en zo snel mogelijk opgelost.
        </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Raadsheer dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Raadsheer! <br>
                    Dit zijn de onderdelen die jij kunt beheren:<br>
                    @foreach($onderdelen as $onderdeel)
                        <br>
                        <a href="{{ route('raadsheer.onderdeel', ['id' => $onderdeel->id]) }}">
                            {{ ucfirst($onderdeel->onderdeel) }}
                        </a>
                        <span class="float-right"><a href="{{ route('raadsheer.discipline.excelDownload', ['id' => $onderdeel->id]) }}">Download excel bestand met gegevens</a></span>
                        <hr style="margin-bottom: 0; margin-top: 0;">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
