@extends('raadsheer.layouts.app')
@section('content')

    
{{--    <a href="#"><button class="btn btn-primary btn-block">Download (alleen deze vraag)</button></a>--}}
{{--    TODO Exceldownload--}}
    <br>
{{--@dump($vraag)--}}
    <h2>{{ $vraag->tekst }}</h2>
    @foreach($vraag->antwoord()->orderBy('antwoord', 'DESC')->orderBy('NBFS', 'ASC')->get() as $antwoord)
{{--        @dump($antwoord)--}}
        {{ $antwoord->gilden->id }} {{ $antwoord->gilden->name }}

        <span class="float-right">
            @if($vraag->type === 'boolean')
                {{ $antwoord->antwoord ? 'Ja' : 'Nee' }}
            @else
                {{ $antwoord->antwoord }}
            @endif
                
        </span><br>
        <hr>
    @endforeach

@endsection
