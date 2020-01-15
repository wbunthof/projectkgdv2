@extends('layouts.app')
@section('content')

@foreach($discipline->leden as $lid)
    {{ $lid->leden_id }} {{ $lid->voornaam }} {{ $lid->achternaam }} {{ $lid->gilde->name }}<br>
@endforeach

@endsection
