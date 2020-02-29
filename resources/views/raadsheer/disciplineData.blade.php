@extends('raadsheer.layouts.app')
@section('content')
{{--    <a href="#"><button class="btn btn-primary btn-block">Download (Alleen deze klasse)</button></a>--}}
    {{--    TODO Exceldownload--}}
    <br>
    <h2>{{ $discipline->naam }}</h2>
    
@forelse($discipline->leden as $lid)
    {{ $lid->leden_id }} {{ $lid->voornaam }} {{ $lid->achternaam }} {{ $lid->gilde->name }}<br>
    @empty
    Geen leden
    @endforelse

@endsection
