@extends('raadsheer.layouts.app')
@section('content')
    <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
        Vraag toevoegen
    </button>
    <br>
    <!-- Modal voor het toevoegen van vragen -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Raadsheer toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['class' => 'form', 'url' => route('raadsheer.vraag.create'), 'method' => 'POST']) !!}

                    {!! Form::hidden('_method', 'put') !!}
                    {!! Form::hidden('formonderdeel_id', $formonderdeel->id) !!}
                    {!! Form::token() !!}

                    {!! Form::label('tekst', 'Vul hier de vraag in die gesteld moet worden.') !!}
                    {!! Form::text('tekst', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de vraag in', 'required']) !!}

                    {!! Form::label('extrainfo', 'Vul hier de extra info in, voor als de vraag niet helemaal duidelijk is voor de secretarissen.') !!}
                    {!! Form::textarea('extrainfo', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de extra info in.', 'required']) !!}
                    <br>
                    Type:
                    <br>
                    @php($data =
                                [['name' => 'Ja/Nee vraag', 'type' => 'B', 'extra' => []],
                                ['name' => 'Nummer vraag', 'type' => 'N', 'extra' => ['minimum', 'maximum', 'placeholder']],
                                ['name' => 'Tekst vraag (kort antwoord)', 'type' => 'T', 'extra' => ['maximum', 'placeholder']],
                                ['name' => 'Tekst vraag (lang antwoord)', 'type' => 'TA', 'extra' => ['maximum', 'placeholder']],
                                ['name' => 'Speciaal, niet aanpassen!!']])
{{--                        TODO 'speciaal niet aanpassen' => onmogelijk maken voor de gebruiker--}}
                    {!! Form::select('type', [  'boolean' => 'Ja/Nee Vraag',
                                                'number' => 'Nummer vraag',
                                                'tekst' => 'Tekst vraag (kort antwoord)',
                                                'tekstarea' => 'Tekst vraag (lang antwoord)',
                                                'Special' => 'Speciaal, niet aanpassen!!!'], null, ['class' => 'form-control',
                                                'oninput' => 'if(this.value == "B" || this.value == "Special") {
                                                document.getElementById("vragen").style.display = "none";
                                                } else { document.getElementById("vragen").style.display = "";
                                                }']) !!}
                    <hr>
                    <div id="vragen" style="display: none">
                        <hr>
                        <h3>Details over de vraag</h3><br>
                        {!! Form::label('minimumValue', 'Minimale aantal') !!}
                        {!! Form::number('minimumValue', null, ['min' => 0, 'class' => 'form-control']) !!}

                        {!! Form::label('maximumValue', 'Maximale aantal') !!}
                        {!! Form::number('maximumValue', null, ['min' => 0, 'class' => 'form-control']) !!}

                        {!! Form::label('placeholder', 'Tekst die achter de vraag komt te staan zoals deze:') !!}
                        {!! Form::text('placeholder', null, ['class' => 'form-control', 'placeholder' => 'Dit is dus de tekst']) !!}
                        <br>
                    </div>
                    {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>

    @foreach($onderdelen as $vraag)
        <br>
        <!-- Modal voor het bewerken van een vraag -->
        <div class="modal fade" id="updateVraag{{$vraag->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="updateVraag{{$vraag->id}}ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateVraag{{$vraag->id}}ModalLabel">{{$vraag->tekst}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['class' => 'form', 'url' => route('raadsheer.vraag.update', ['id' => $vraag->id]), 'method' => 'POST']) !!}

                        {!! Form::hidden('_method', 'patch') !!}
                        {!! Form::token() !!}

                        {!! Form::label('tekst' . $vraag->id, 'Vul hier de vraag in die gesteld moet worden.') !!}
                        {!! Form::text('tekst' . $vraag->id, $vraag->tekst, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de vraag in', 'required']) !!}

                        {!! Form::label('extrainfo' . $vraag->id, 'Vul hier de extra info in, voor als de vraag niet helemaal duidelijk is voor de secretarissen.') !!}
                        {!! Form::textarea('extrainfo' . $vraag->id, $vraag->extrainfo, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de extra info in.', 'required']) !!}
                        <br>
                        Type:
                        <br>
                        @php($data =
                                    [['name' => 'Ja/Nee vraag', 'type' => 'B', 'extra' => []],
                                    ['name' => 'Nummer vraag', 'type' => 'N', 'extra' => ['minimum', 'maximum', 'placeholder']],
                                    ['name' => 'Tekst vraag (kort antwoord)', 'type' => 'T', 'extra' => ['maximum', 'placeholder']],
                                    ['name' => 'Tekst vraag (lang antwoord)', 'type' => 'TA', 'extra' => ['maximum', 'placeholder']],
                                    ['name' => 'Speciaal, niet aanpassen!!']])
                        {{--                        TODO 'speciaal niet aanpassen' => onmogelijk maken voor de gebruiker--}}
                        {!! Form::select('type' . $vraag->id, [ 'boolean' => 'Ja/Nee Vraag',
                                                                'number' => 'Nummer vraag',
                                                                'tekst' => 'Tekst vraag (kort antwoord)',
                                                                'tekstarea' => 'Tekst vraag (lang antwoord)',
                                                                'special' => 'Speciaal, niet aanpassen!!!'],
                                                                $vraag->type,
                                                                ['class' => 'form-control',
                                                                'oninput' => 'if(this.value == "B" || this.value == "Special") {
                                                                document.getElementById("vragen").style.display = "none";
                                                                } else { document.getElementById("vragen").style.display = "";
                                                                }']) !!}
                        <hr>
                        <div id="vragen" style="@if($vraag->type == 'boolean' || $vraag->type == 'special')display: none @endif">
                            <hr>
                            <h3>Details over de vraag</h3><br>
                            {!! Form::label('minimumValue' . $vraag->id, 'Minimale aantal') !!}
                            {!! Form::number('minimumValue' . $vraag->id, null, ['min' => 0, 'class' => 'form-control']) !!}

                            {!! Form::label('maximumValue' . $vraag->id, 'Maximale aantal') !!}
                            {!! Form::number('maximumValue' . $vraag->id, null, ['min' => 0, 'class' => 'form-control']) !!}

                            {!! Form::label('placeholder' . $vraag->id, 'Tekst die achter de vraag komt te staan zoals deze:') !!}
                            {!! Form::text('placeholder' . $vraag->id, null, ['class' => 'form-control', 'placeholder' => 'Dit is dus de tekst']) !!}
                            <br>
                        </div>
                        {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        {{ $vraag->tekst }}
        {{--            {{ $vraag->setTypeAttribute($vraag->type) }}--}}
        {{ ucfirst($vraag->type) }}
        <div class="btn btn-group float-right">
            <button class="btn btn-secondary" type="submit">Data</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateVraag{{$vraag->id}}Modal">Bewerken</button>
            <a class="btn btn-danger" href="{{ route('raadsheer.vraag.destroy', ['id' => $vraag->id]) }}" onclick="event.preventDefault(); document.getElementById('form-logout-{{$vraag->id}}').submit();">Verwijderen</a>
            {!! Form::open(['id' => 'form-logout-' . $vraag->id,'class' => 'form', 'url' => route('raadsheer.vraag.destroy', ['id' => $vraag->id]), 'method' => 'POST']) !!}
            {!! Form::hidden('_method', 'DELETE') !!}
            {!! Form::close() !!}
        </div>
        <hr>
        <br>
    @endforeach
@endsection


