{{--  #
      # Code van Wouter
      #
      # --}}

@extends('admin.layouts.app')

@section('content')
<div class="container">
  <h1>Het account van {{ Auth::User()->name}}</h1>
  @php
    $index = ['name', 'email', 'straat', 'huisnummer'];
  @endphp


    @foreach($index as $key => $onderdeel)
        {!! Form::open(['url' => route('admin.account'), 'method' => 'POST', 'class' => 'form-inline']) !!}
        {!! Form::token() !!}
        {!! Form::hidden('_method', 'PUT') !!}
        <div class="form-group mb-2">
            <label for="static{{$key}}" class="sr-only">{{ucfirst($onderdeel)}}</label>
            <input type="text" readonly class="form-control-plaintext" id="static{{$key}}" value="{{ucfirst($onderdeel)}}">
    </div>
        {!! Form::text($onderdeel, Auth::User()->$onderdeel, ['name' => $onderdeel, 'class' => 'form-control', 'style' => 'margin-right: 8px;']) !!}
        {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mb-2']) !!}
        {!! Form::close() !!}
    @endforeach
</div>
@endsection
