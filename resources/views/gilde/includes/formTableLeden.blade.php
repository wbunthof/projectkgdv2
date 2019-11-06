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
				@php
					$route = 'gilde/inschrijffomulier/'.$onderdeel.'/lidToevoegen';
				@endphp

				<p><u>Leden die niet gevonden kunnen worden moeten bij het onderdeel "Junioren & leden zonder pas" toegevoegd worden</u></p>

				{!! Form::open(['class' => 'form', 'url' => $route, 'method' => 'POST', 'autocomplete' => str_random(55)]) !!}

				{!! Form::hidden('_method', 'put') !!}
				{!! Form::token() !!}
				{!! Form::hidden('onderdeel', $onderdeel, []) !!}

				{!! Form::label('Nummer', 'Als u het nummer/voornaam/achternaam intypt wordt er automatisch een lid voorgesteld graag deze gebruiken en er zelf geen aan toevoegen.', []) !!}
				{!! Form::number('nummer', '', ['autocomplete' => str_random(55), 'id' => 'id', 'class' => 'form-control mb-2 mr-sm-2', 'onkeyup' => 'LidOpzoeken(0, this.value, "' . $onderdeel . '", "' . url('') . '")', 'placeholder' => 'Nummer']) !!}
				{!! Form::text('voornaam', '', ['autocomplete' => str_random(55), 'id' => 'voornaam', 'class' => 'form-control mb-2 mr-sm-2', 'onkeyup' => 'LidOpzoeken(1, this.value, "' . $onderdeel . '", "' . url('') . '")', 'placeholder' => 'Voornaam']) !!}
				{!! Form::text('achternaam', '', ['id' => 'achternaam', 'class' => 'form-control mb-2 mr-sm-2', 'autocomplete' => str_random(55), 'onkeyup' => 'LidOpzoeken(2, this.value, "' . $onderdeel . '", "' . url('') . '")', 'placeholder' => 'Achternaam']) !!}
				<div class="container" id='tabelVoorLeden'></div>
				@foreach ($KolommenDieKunnenVeranderenMetSpatie as $kolomveranderd1)
					<div class="form-check">
						{!! Form::radio('discipline', $kolomveranderd1, false, ['id' => $kolomveranderd1, 'class' => 'form-check-input', 'required']) !!}
						{!! Form::label($kolomveranderd1, ucfirst($kolomveranderd1), ['class' => 'form-check-label']) !!}
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

{{-- Lid toevoegen button -> activeert het toevoegenModal  --}}
<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
	Lid toevoegen voor het {{{$onderdeel}}} (klik hier)
</button>
<br>
<div class="table-responsive">
<table class="table">
  <thead>
	@if ($emptyLeden)
		{{-- Melding als er nog geen leden ingevuld zijn --}}
			<tr>
				<th>Geen leden ingevuld. <br>
					Als er geen leden toegevoegd zijn, gaan wij er automatische vanuit dat er geen indivduele leden meedoen aan {{{$onderdeel}}} (zodra de deadline verstreken is).</th>
			</tr>
		<thead>
	@else
			<tr>
				{{-- Kolomnamen --}}
	      <th class="align-top">Nummer:</th>
				<th class="align-top">Voorletter:</th>
				<th class="align-top">Achternaam:</th>
				@foreach ($KolommenDieKunnenVeranderenMetSpatie as $kolomVeranderd1)
					<th class="align-top">{{ucfirst($kolomVeranderd1)}}:</th>
				@endforeach
				<th class="align-top">Opties</th>
				</tr>
	  </thead>
	  <tbody>
				@foreach ($leden as $lid)
	    <tr>
				{{-- Gebruikergegevens --}}
				{{-- {{dump($lid)}} --}}
	      <td><b>{{{$lid->leden->leden_id}}}</b></td>
				<td>{{{$lid->leden->voorletter}}}</td>
				<td>{{{$lid->leden->achternaam}}}</td>
				{{-- Radios om keuze te maken in discipline --}}
				@foreach ($KolommenDieKunnenVeranderen as $kolomVeranderd2)
					<td> @php $csrf = csrf_token();	@endphp
						{!! Form::radio($lid->leden_id, $kolomVeranderd2, $lid->$kolomVeranderd2, ['onclick' => 'lidUpdatenInschrijfformulier('. $lid->id.', "'. $kolomVeranderd2 .'", "lidUpdaten", "'. $csrf .'");']) !!}</td>
				@endforeach
				{{-- Verwijder button verwerkt in form --}}
				<td>@php $route = 'gilde/inschrijffomulier/'.$onderdeel.'/lidVerwijderen';	@endphp
				{!! Form::open(['url' => $route, 'method' => 'POST']) !!}

				{!! Form::hidden('_method', 'delete') !!}
				{!! Form::hidden('id', $lid->id) !!}
				{!! Form::token() !!}

				{!! Form::submit('Afmelden', ['class' => 'btn btn-secondary']) !!}

				{!! Form::close() !!}

					 </div></td>
	    </tr>
			@endforeach
	  </tbody>
	@endif
</table>
