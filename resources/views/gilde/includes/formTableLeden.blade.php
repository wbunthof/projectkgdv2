{{-- Modal voor het toevoegen van leden --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deelnemers {{$onderdeel}} toevoegen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p><u>Leden die niet gevonden kunnen worden moeten bij het onderdeel "Junioren & leden zonder pas" toegevoegd worden</u></p>

				{!! Form::open(['class' => 'form', 'url' => route('gilde.inschrijffomulier.lidToevoegen'), 'method' => 'POST', 'autocomplete' => Str::random(55)]) !!}

				{!! Form::hidden('_method', 'PUT') !!}
				{!! Form::token() !!}
				{!! Form::hidden('onderdeel', $formonderdeel->id, []) !!}

				{!! Form::label('leden_id', 'Als u het nummer/voornaam/achternaam intypt wordt er automatisch een lid voorgesteld graag deze gebruiken en er zelf geen aan toevoegen.', []) !!}
				{!! Form::number('leden_id', '', ['autocomplete' => Str::random(55), 'id' => 'id', 'class' => 'form-control mb-2 mr-sm-2', 'onkeyup' => 'LidOpzoeken(0, this.value, "' . $formonderdeel->onderdeel . '", "' . url('') . '")', 'placeholder' => 'Nummer']) !!}
				{!! Form::text('voorletter', '', ['autocomplete' => Str::random(55), 'id' => 'voorletter', 'class' => 'form-control mb-2 mr-sm-2', 'onkeyup' => 'LidOpzoeken(1, this.value, "' . $formonderdeel->onderdeel . '", "' . url('') . '")', 'placeholder' => 'Voornaam']) !!}
				{!! Form::text('achternaam', '', ['id' => 'achternaam', 'class' => 'form-control mb-2 mr-sm-2', 'autocomplete' => Str::random(55), 'onkeyup' => 'LidOpzoeken(2, this.value, "' . $formonderdeel->onderdeel . '", "' . url('') . '")', 'placeholder' => 'Achternaam']) !!}
				<div class="container" id='tabelVoorLeden'></div>
				@foreach ($disciplines as $discipline)
					<div class="form-check">
						{!! Form::radio('formonderdelendiscipline_id', $discipline->id, false, ['id' => $discipline->id, 'class' => 'form-check-input', 'required']) !!}
						{!! Form::label($discipline->id, ucfirst($discipline->naam), ['class' => 'form-check-label']) !!}
						<br>
					</div>
				@endforeach

				{!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}
				{!! Form::close() !!}
				<br>
			</div>
		</div>
	</div>
</div>
{{-- Lid toevoegen button activeert het toevoegenModal  --}}

<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
	Lid toevoegen voor het {{ $onderdeel }} (klik hier)
</button>
<br>
<div class="table-responsive">
    <table class="table">
        <thead>
            @if (!($leden->count() > 0))
            {{-- Melding als er nog geen leden ingevuld zijn --}}
                    <tr>
                        <th>Geen leden ingevuld. <br>
                            Als er geen leden toegevoegd zijn, gaan wij er automatisch vanuit dat er geen indivduele leden meedoen aan {{{$onderdeel}}} (zodra de deadline verstreken is).</th>
                    </tr>
                <thead>
            @else
                    <tr>
                        {{-- Kolomnamen --}}
                        <th class="align-top">Nummer:</th>
                        <th class="align-top">Voorletter:</th>
                        <th class="align-top">Achternaam:</th>
                        @foreach ($disciplines as $discipline)
                            <th class="align-top">{{ucfirst($discipline->naam)}}:</th>
                        @endforeach
                        <th class="align-top">Opties</th>
                    </tr>
                 </thead>
                 <tbody>
    				@foreach ($leden as $lid)
    	            <tr>
{{--    				 Gebruikergegevens --}}
{{--    				 {{dump($lid)}} --}}
    	            <td><b>{{$lid->leden_id}}</b></td>
    				<td>{{$lid->voorletter}}</td>
    				<td>{{$lid->achternaam}}</td>
{{--    				 Radios om keuze te maken in discipline --}}
    				@foreach ($disciplines as $discipline)
    					<td>
                        {!! Form::radio($lid->leden_id, $discipline->id, $lid->discipline->id === $discipline->id ? true : false, ['onclick' => 'lidUpdatenInschrijfformulier('. $lid->id.', '. $discipline->id .', "' . route('gilde.inschrijffomulier.lidUpdaten', ['id' => $lid->id]). '", "'. csrf_token() .'");']) !!}
                                


{{--                            @php ($csrf = csrf_token())--}}
{{--                            {{ $lid->discipline->naam }}--}}
                        </td>
    				@endforeach
                    
                {{-- Verwijder button verwerkt in form --}}
    				<td>
    				{!! Form::open(['url' => route('gilde.inschrijffomulier.lidVerwijderen', ['id' => $lid->id]), 'method' => 'POST']) !!}
    
    				{!! Form::hidden('_method', 'DELETE') !!}
    				{!! Form::token() !!}
    
    				{!! Form::submit('Afmelden', ['class' => 'btn btn-secondary']) !!}
    
    				{!! Form::close() !!}
                    </td>
    	    </tr>
    			@endforeach
          </tbody>
        @endif
    </table>
</div>
