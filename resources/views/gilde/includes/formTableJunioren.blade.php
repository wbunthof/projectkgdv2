{{-- Modal voor het toevoegen van junioren --}}
<div class="modal fade" id="ModalJunioren" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Junioren & leden zonder pas toevoegen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['class' => 'form', 'url' => route('gilde.inschrijffomulier.juniorToevoegen'), 'method' => 'POST', 'autocomplete' => str_random(55)]) !!}

				{!! Form::hidden('_method', 'put') !!}
				{!! Form::token() !!}

				{!! Form::label('voornaam', 'Vul hier de gegevens van de junioren in', []) !!}
				{!! Form::text('voornaam', '', ['autocomplete' => str_random(55), 'id' => 'voornaam', 'class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Voornaam']) !!}
				{!! Form::text('achternaam', '', ['id' => 'achternaam', 'class' => 'form-control mb-2 mr-sm-2', 'autocomplete' => str_random(55), 'placeholder' => 'Achternaam']) !!}
				{!! Form::label('geboortedatum', 'Vul hier de geboortedatum in (ouder dan: ' . date('Y-m-d', mktime(0,0,0,1,1, date('Y')-15)) . ' is senior)', []) !!}
				{!! Form::date('geboortedatum', '', ['class' => 'form-control mb-2 mr-sm-2']) !!}
				@foreach ($klasse as $klas)
					<div class="form-check">
						{!! Form::radio('klasse', $klas->id, false, ['id' => $klas->id, 'class' => 'form-check-input', 'required']) !!}
						{!! Form::label($klas->id, ucfirst($klas->klasse), ['class' => 'form-check-label']) !!}
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
	<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#ModalJunioren">
		Junioren & leden zonder pas toevoegen (klik hier)
	</button>
	<br>
	<div class="table-responsive">
	<table class="table">
	  <thead>
			@if ($emptyJunioren)
				{{-- Melding als er nog geen leden ingevuld zijn --}}
				<tr>
					<th>Geen leden of junioren ingevuld die geen pas hebben. <br>
							Als er geen leden toegevoegd zijn, gaan wij er automatische vanuit dat er geen indivduele leden zijn die geen pas hebben (zodra de deadline verstreken is).
							</th>
				</tr>
				<thead>
			@else
				<tr>
					{{-- Kolomnamen --}}
		      <th class="align-top">Voornaam:</th>
					<th class="align-top">Achternaam:</th>
					<th class="align-top">Geboortedatum:</th>
					<th class="align-top">Klasse:</th>
					<th class="align-top">Opties</th>
					</tr>
		  </thead>
		  <tbody>
				@foreach ($junioren as $lid)
		    <tr>
					{{-- Gebruikergegevens --}}
					<td>{{{$lid->voornaam}}}</td>
					<td>{{{$lid->achternaam}}}</td>
					<td>{{{$lid->geboortedatum}}}</td>
					<td>{{{$lid->JuniorenDiscipline->klasse}}}</td>
					{{-- Verwijder button verwerkt in form --}}
					<td>@php $route = 'gilde/inschrijffomulier/'.$onderdeel.'/lidVerwijderen';	@endphp
					{!! Form::open(['url' => route('gilde.inschrijffomulier.juniorVerwijderen', ['formonderdeel' => $onderdeel]), 'method' => 'POST']) !!}

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
