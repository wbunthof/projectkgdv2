{{--  #
      # Code van Wouter
      #
      # --}}

@extends('raadsheer.layouts.app')

@section('content')
<div class="container">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
