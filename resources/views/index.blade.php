{{--  #
      # Code van Wouter
      #
      # --}}

@extends('layouts.app')

@section('content')

    @foreach($gilden as $gilde)
        <div class="row">
            <div class="col-6">
                {{ $gilde->id }} {{ $gilde->name }}
            </div>
            <div class="col-6">
                {{ $gilde->email }}
            </div>
        </div>
    @endforeach
    <br>
    <br>
    {{ count($gilden) }}
    <br>
    <br>
    @foreach($gilden as $gilde)
        {{ $gilde->email }}; <br>
    @endforeach
@endsection
