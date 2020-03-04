@extends('organiser.layouts.app')
@section('content')

    <a href="{{route('organiser.formulieronderdeel.download', ['formulieronderdeel' => $formonderdeel->id])}}" class="btn btn-secondary btn-block">Download</a>
    <br>
    @foreach($formonderdeel->vraag as $vraag)
{{--    @dump($vraag)--}}
    <div class="row">
        <div class="col-4">
            {{ $vraag->tekst }}
        </div>
        <div class="col-8">
            @php($i = 0)
        @foreach($vraag->antwoord as $antwoord)
            <div class="row">
                <div class="col-6">
                    {{ $antwoord->gilden->name }}
                </div>
                <div class="col-6">
                    @if($vraag->type == 'boolean')
                        @if($antwoord->antwoord)
                            Ja
                            @php($i++)
                            @else
                            Nee
                        @endif
                    @else
                        {{$antwoord->antwoord}}
                    @endif
                </div>
            </div>
        @endforeach
            @if($vraag->type == 'number')
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        Gemiddeld: {{ round($vraag->antwoord->avg('antwoord')) }} <br>
                        Totaal: {{ $vraag->antwoord->sum('antwoord') }} <br>
                    </div>
                </div>
            @elseif($vraag->type == 'boolean')
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        Totaal: {{ $i }} <br>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <hr>
@endforeach

@endsection
