@extends('raadsheer.layouts.app')
@section('content')

    <h1>{{ ucfirst($formonderdeel->onderdeel) }}</h1>

    @if($formonderdeel->leden)

        <h2>
            <a data-toggle="collapse" href="#collapseDisciplines" role="button" aria-expanded="false" aria-controls="collapseExample">
                Disciplines voor leden
            </a>
        </h2>
        <div class="collapse show" id="collapseDisciplines">
            <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#newDisciplineModal">
                Discipline toevoegen
            </button>
            <br>
            <!-- Modal voor het toevoegen van disciplines -->
            <div class="modal fade" id="newDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="newDisciplineModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newDisciplineModalLabel">Discipline toevoegen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['class' => 'form', 'url' => route('raadsheer.discipline.create'), 'method' => 'POST']) !!}

                            {!! Form::hidden('_method', 'put') !!}
                            {!! Form::hidden('formonderdeel_id', $formonderdeel->id) !!}
                            {!! Form::token() !!}

                            {!! Form::label('naam', 'Vul hier de naam van de nieuwe discipline in.') !!}
                            {!! Form::text('naam', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de discipline in', 'required']) !!}

                            {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @foreach($formonderdeel->formonderdelendiscipline as $discipline)
            {{ $discipline->naam }}
            <div class="btn btn-group float-right">
                <button class="btn btn-secondary" type="submit">Data</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateDiscipline{{$discipline->id}}Modal">Bewerken</button>
                <a class="btn btn-danger" href="{{ route('raadsheer.discipline.destroy', ['id' => $discipline->id]) }}" onclick="event.preventDefault(); document.getElementById('deleteDiscipline-{{$discipline->id}}').submit();">Verwijderen</a>
                {!! Form::open(['id' => 'deleteDiscipline-' . $discipline->id,'class' => 'form', 'url' => route('raadsheer.discipline.destroy', ['id' => $discipline->id]), 'method' => 'POST']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
            </div>

            <!-- Modal voor het bewerken van disciplines -->
            <div class="modal fade" id="updateDiscipline{{$discipline->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="updateDiscipline{{$discipline->id}}ModallLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateDiscipline{{$discipline->id}}ModalLabel">Discipline toevoegen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['class' => 'form', 'url' => route('raadsheer.discipline.update', ['id' => $discipline->id]), 'method' => 'POST']) !!}

                            {!! Form::hidden('_method', 'PATCH') !!}
                            {!! Form::token() !!}

                            {!! Form::label('naam' . $discipline->id, 'Vul hier de nieuwe naam van de discipline in. Let op! de leden die voor deze discipline al eerder zijn aangemeld blijven aangemeld.') !!}
                            {!! Form::text('naam' . $discipline->id, $discipline->naam, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de discipline in', 'required']) !!}

                            {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mb-2']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <br>
        @endforeach
    </div>
    <h2>
        <a data-toggle="collapse" href="#collapseLeden" role="button" aria-expanded="false" aria-controls="collapseExample">
            Leden (klik)
        </a>
    </h2>

        <div class="collapse show" id="collapseLeden">
            <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#newLidModal">
                Lid toevoegen
            </button>
            <br>
            <!-- Modal voor het toevoegen van leden -->
            <div class="modal fade" id="newLidModal" tabindex="-1" role="dialog" aria-labelledby="newLidModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newLidModalLabel">Lid toevoegen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['class' => 'form', 'url' => route('raadsheer.leden.create'), 'method' => 'POST']) !!}

                            {!! Form::hidden('_method', 'put') !!}
                            {!! Form::hidden('formonderdeel_id', $formonderdeel->id) !!}
                            {!! Form::token() !!}

                            {!! Form::label('leden_id', 'Identificatienummer*') !!}
                            {!! Form::number('leden_id', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Identificatienummer', 'required']) !!}

                            {!! Form::label('', 'Naam') !!}
                            <div class="form-row">
                                <div class="col">
{{--                                    {!! Form::label('voornaam', 'Voornaam:') !!}--}}
                                    {!! Form::text('voornaam', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Voornaam*', 'required']) !!}
                                </div>
                                <div class="col">
{{--                                    {!! Form::label('tussenvoegsel', 'Tussenvoegsel:') !!}--}}
                                    {!! Form::text('tussenvoegsel', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Tussenvoegsel']) !!}
                                </div>
                                <div class="col">
{{--                                    {!! Form::label('achternaam', 'Achternaam') !!}--}}
                                    {!! Form::text('achternaam', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Achternaam*', 'required']) !!}

                                </div>
                            </div>


                            {!! Form::label('geboortedatum', 'Geboortedatum*') !!}
                            {!! Form::date('geboortedatum', '', ['class' => 'form-control mb-2 mr-sm-2']) !!}

                            {!! Form::label('', 'Adres') !!}
                            <div class="form-row">
                                <div class="col-5">
                                    {!! Form::text('straat' , '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Straat']) !!}
                                </div>
                                <div class="col-2">
                                    {!! Form::text('huisnummer', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Huisnumer']) !!}
                                </div>
                                <div class="col-5">
                                    {!! Form::text('plaats', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Plaats']) !!}
                                </div>
                            </div>

                            {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @foreach($formonderdeel->ledenAll()->orderBy('leden_id')->get() as $lid)
                    <div class="row">
                        <div class="col-md-2">
                            {{ $lid->leden_id }}
                        </div>
                        <div class="col-3">
                            {{ $lid->voornaam }} {{$lid->tussenvoegsel}} {{$lid->achternaam}}
                        </div>
                        <div class="col col-lg-4">
                            {{ $lid->plaats }}
                        </div>
                        <div class="col-md-auto btn btn-group">
                            <button class="btn btn-secondary" type="submit">Data</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateLidModal{{$lid->id}}">Bewerken</button>
                            <a class="btn btn-danger" href="{{ route('raadsheer.leden.destroy', ['id' => $lid->id]) }}" onclick="event.preventDefault(); document.getElementById('deleteLeden{{$lid->id}}').submit();">Verwijderen</a>
                            {!! Form::open(['id' => 'deleteLeden' . $lid->id,'class' => 'form', 'url' => route('raadsheer.leden.destroy', ['id' => $lid->id]), 'method' => 'POST']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="modal fade" id="updateLidModal{{ $lid->id }}" tabindex="-1" role="dialog" aria-labelledby="updateLidModal{{ $lid->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateLidModal{{ $lid->id }}Label">Lid toevoegen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['class' => 'form', 'url' => route('raadsheer.leden.update', ['id' => $lid->id]), 'method' => 'POST']) !!}

                                    {!! Form::hidden('_method', 'PAtCH') !!}
                                    {!! Form::hidden('formonderdeel_id', $formonderdeel->id) !!}
                                    {!! Form::token() !!}

                                    {!! Form::label('leden_id', 'Identificatienummer*') !!}
                                    {!! Form::number('leden_id', $lid->leden_id, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Identificatienummer', 'required']) !!}

                                    {!! Form::label('', 'Naam') !!}
                                    <div class="form-row">
                                        <div class="col">
                                            {{--                                    {!! Form::label('voornaam', 'Voornaam:') !!}--}}
                                            {!! Form::text('voornaam', $lid->voornaam, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Voornaam*', 'required']) !!}
                                        </div>
                                        <div class="col">
                                            {{--                                    {!! Form::label('tussenvoegsel', 'Tussenvoegsel:') !!}--}}
                                            {!! Form::text('tussenvoegsel', $lid->tussenvoegsel, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Tussenvoegsel']) !!}
                                        </div>
                                        <div class="col">
                                            {{--                                    {!! Form::label('achternaam', 'Achternaam') !!}--}}
                                            {!! Form::text('achternaam', $lid->achternaam, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Achternaam*', 'required']) !!}

                                        </div>
                                    </div>


                                    {!! Form::label('geboortedatum', 'Geboortedatum*') !!}
                                    {!! Form::date('geboortedatum', $lid->geboortedatum, ['class' => 'form-control mb-2 mr-sm-2']) !!}

                                    {!! Form::label('', 'Adres') !!}
                                    <div class="form-row">
                                        <div class="col-5">
                                            {!! Form::text('straat' , $lid->straat, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Straat']) !!}
                                        </div>
                                        <div class="col-2">
                                            {!! Form::text('huisnummer', $lid->huisnummer, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Huisnumer']) !!}
                                        </div>
                                        <div class="col-5">
                                            {!! Form::text('plaats', $lid->plaats, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Plaats']) !!}
                                        </div>
                                    </div>

                                    {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mb-2']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach
        </div>
    @endif

    @if($formonderdeel->vragen)
        <h2>
            <a data-toggle="collapse" href="#collapseVragen" role="button" aria-expanded="false" aria-controls="collapseExample">
                Vragen
            </a>
        </h2>
        <div class="collapse show" id="collapseVragen">
        <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
            Vraag toevoegen
        </button>
        <br>
        <!-- Modal voor het toevoegen van vragen -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vraag toevoegen</h5>
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

                        {!! Form::label('extraInfo', 'Vul hier de extra info in, voor als de vraag niet helemaal duidelijk is voor de secretarissen.') !!}
                        {!! Form::textarea('extraInfo', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de extra info in.']) !!}
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
                                                    'text' => 'Tekst vraag (kort antwoord)',
                                                    'textarea' => 'Tekst vraag (lang antwoord)',
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

                            {!! Form::label('extraInfo' . $vraag->id, 'Vul hier de extra info in, voor als de vraag niet helemaal duidelijk is voor de secretarissen.') !!}
                            {!! Form::textarea('extraInfo' . $vraag->id, $vraag->extraInfo, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de extra info in.']) !!}
                            <br>

    {{--                        {!! Form::label('type' . $vraag->id, 'Type: Als je dit aanpast worden de ingevulde antwoorden gewist! Tenzij dat er van "Tekst vraag (lang antwoord)" van of naar "Tekst vraag (kort antwoord)" wordt het wordt alleen ingekort indien nodig. ') !!}--}}
                            <label for="type{{ $vraag->id }}">Type:
                                                            <br> Als je dit aanpast worden de ingevulde antwoorden gewist!
                                                            <br>Tenzij dat er van "Tekst vraag (lang antwoord)" van of naar "Tekst vraag (kort antwoord)" wordt het wordt alleen ingekort indien nodig. </label>
                            @php($data =
                                        [['name' => 'Ja/Nee vraag', 'type' => 'B', 'extra' => []],
                                        ['name' => 'Nummer vraag', 'type' => 'N', 'extra' => ['minimum', 'maximum', 'placeholder']],
                                        ['name' => 'Tekst vraag (kort antwoord)', 'type' => 'T', 'extra' => ['maximum', 'placeholder']],
                                        ['name' => 'Tekst vraag (lang antwoord)', 'type' => 'TA', 'extra' => ['maximum', 'placeholder']],
                                        ['name' => 'Speciaal, niet aanpassen!!']])
                            {{--                        TODO 'speciaal niet aanpassen' => onmogelijk maken voor de gebruiker--}}
                            {!! Form::select('type' . $vraag->id, [ 'boolean' => 'Ja/Nee Vraag',
                                                                    'number' => 'Nummer vraag',
                                                                    'text' => 'Tekst vraag (kort antwoord)',
                                                                    'textarea' => 'Tekst vraag (lang antwoord)',
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
                                {!! Form::number('minimumValue' . $vraag->id, $vraag->minimumValue, ['min' => 0, 'class' => 'form-control']) !!}

                                {!! Form::label('maximumValue' . $vraag->id, 'Maximale aantal') !!}
                                {!! Form::number('maximumValue' . $vraag->id, $vraag->maximumValue, ['min' => 0, 'class' => 'form-control']) !!}

                                {!! Form::label('placeholder' . $vraag->id, 'Tekst die achter de vraag komt te staan zoals deze:') !!}
                                {!! Form::text('placeholder' . $vraag->id, $vraag->placholder, ['class' => 'form-control', 'placeholder' => 'Dit is dus de tekst']) !!}
                                <br>
                            </div>
                            {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mb-2']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{ $vraag->tekst }}
            <div class="btn btn-group float-right">
                <button class="btn btn-secondary" type="submit">Data</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateVraag{{$vraag->id}}Modal">Bewerken</button>
                <a class="btn btn-warning" href="{{ route('raadsheer.vraag.destroy', ['id' => $vraag->id]) }}" onclick="event.preventDefault(); document.getElementById('deleteVraag{{$vraag->id}}').submit();">Deactiveren</a>
                {!! Form::open(['id' => 'deleteVraag' . $vraag->id,'class' => 'form', 'url' => route('raadsheer.vraag.destroy', ['id' => $vraag->id]), 'method' => 'POST']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
            </div>
            <hr>
            <br>
        @endforeach
        @if($deletedVragen->count())
        <hr>
        <h2>Verwijderde vragen</h2>

        @foreach($deletedVragen as $vraag)
            {{ $vraag->tekst }}
            <div class="btn btn-group float-right">
                <a class="btn btn-warning" href="{{ route('raadsheer.vraag.undelete', ['id' => $vraag->id]) }}" onclick="event.preventDefault(); document.getElementById('undeleteVraag{{$vraag->id}}').submit();">Terugzetten</a>
                {!! Form::open(['id' => 'undeleteVraag' . $vraag->id,'class' => 'form', 'url' => route('raadsheer.vraag.undelete', ['id' => $vraag->id]), 'method' => 'POST']) !!}
                {!! Form::hidden('_method', 'PATCH') !!}
                {!! Form::close() !!}
                <a class="btn btn-danger" href="{{ route('raadsheer.vraag.permanentDelete', ['id' => $vraag->id]) }}" onclick="event.preventDefault(); document.getElementById('permanentdelete-{{$vraag->id}}').submit();">Permanent verwijderen!</a>
                {!! Form::open(['id' => 'permanentdelete-' . $vraag->id,'class' => 'form', 'url' => route('raadsheer.vraag.permanentDelete', ['id' => $vraag->id]), 'method' => 'POST']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
            </div>
            <hr>
            <br>
        @endforeach
        @endif
        </div>
    @endif

@endsection


