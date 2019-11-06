{{--  #
      # Code van Wouter
      #
      # --}}

@extends('layouts.app')

@section('content')

          <div class="jumbotron text-center">
              <h1>Inloggen Kringgildedag 2019</h1>
              <div style="width: 100%">
                <a class="btn btn-primary btn-block" href="{{ route('admin.login')}}">Admin</a>
                <a class="btn btn-primary btn-block" href="{{ route('organiser.login')}}">Organiserend Gilde</a>
                <a class="btn btn-primary btn-block" href="{{ route('raadsheer.login')}}">Raadsheren</a>
                <a class="btn btn-primary btn-block" href="{{ route('gilde.login')}}">Gilden</a>
              </div>
          </div>

@endsection
