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


  @for ($i=0; $i < count($index); $i++)
    @php
      $indexStr = (string)$index[$i];
    @endphp

    {!! Form::open(['url' => route('admin.account'), 'method' => 'POST']) !!}
    {!! Form::token() !!}
    {!! Form::hidden('_method', 'PUT') !!}
    {!! Form::hidden('onderdeel', $indexStr) !!}
    {!! Form::hidden('id',  Auth::User()->id) !!}
    <div class="form-group mb-2">
      <label for="static{{$i}}" class="sr-only">{{ucfirst($indexStr)}}</label>
      <input type="text" readonly class="form-control-plaintext" id="static{{$i}}" value="{{ucfirst($indexStr)}}">
    </div>
    {!! Form::text($indexStr, Auth::User()->$indexStr, ['name' => 'waarde', 'class' => 'form-group']) !!}
    {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mb-2']) !!}
    {!! Form::close() !!}
    @endfor
</div>
@endsection
