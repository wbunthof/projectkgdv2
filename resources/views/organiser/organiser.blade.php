{{--  #
      # Code van Wouter
      #
      # --}}

@extends('organiser.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Algemene info over gilden</h5>
                        <p class="card-text">Hier vind je de algemene gegevens van de gilden en de voortgang.</p>
                        <a href="{{ route('organiser.gilden.algemeen') }}" class="btn btn-primary">Klik hier voor info</a>
                        <a href="{{ route('organiser.gilden.algemeen.download') }}" class="btn btn-secondary">Klik hier voor download</a>
                    </div>
                </div>
            </div>
            
            <div class="col-auto mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Info per formulier onderdeel</h5>
                        <p class="card-text">Hier vind je de info en antwoorden per formulier onderdeel.</p>
                        <a href="{{ route('organiser.formulieronderdeel.algemeen') }}" class="btn btn-primary">Klik hier voor info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
