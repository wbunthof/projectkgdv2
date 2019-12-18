@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($onderdelen as $vraag)
            {{ $vraag->tekst }}
{{--            {{ $vraag->setTypeAttribute($vraag->type) }}--}}
            {{ ucfirst($vraag->type) }}
            <div class="btn btn-group float-right">
                <button class="btn btn-secondary" type="submit">Data</button>
                <button class="btn btn-primary" type="submit">Bewerken</button>
                <button class="btn btn-danger" type="submit" href="https:://www.google.com">Verwijderen</button>
            </div>
            <hr>
            <br>
        @endforeach
    </div>

@endsection


