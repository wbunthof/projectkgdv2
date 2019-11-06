{{--  #
      # Code van Wouter
      #
      # --}}

@extends('gilde.layouts.app')

@section('content')
{{-- Modal voor het toevoegen van gilden --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Leden toevoegen (u dient ook de disciplines in te vullen)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@php
					$route = 'gilde/inschrijffomulier/deelname-meerdere-wedstrijden/3/Toevoegen';
				@endphp
				{{-- Het toevoegen van een lid dat aan meerdere disciplines mee doet, dit is heel eenovoudig gemaakt ivm tijd nood--}}
				{!! Form::open(['class' => 'form', 'url' => $route, 'method' => 'POST']) !!}

				{!! Form::hidden('_method', 'put') !!}
				{!! Form::token() !!}
				{!! Form::hidden('onderdeel', $onderdeel, []) !!}

				{!! Form::label('Naam', 'Naam:', []) !!}
				{!! Form::text('Naam', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Naam']) !!}
				{!! Form::label('Disciplines', 'Disciplines:', []) !!}
				{!! Form::textarea('Disciplines', '', ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Vul hier de disciplines in']) !!}

				@foreach ($KolommenDieKunnenVeranderenMetSpatie as $kolomveranderd1)
					<div class="form-check">
						{!! Form::radio('discipline', $kolomveranderd1, false, ['id' => $kolomveranderd1, 'class' => 'form-check-input']) !!}
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




<div class="text-justify-center container">
	<br>
	<h2>{{{ucfirst($onderdeel)}}}</h2>
	<hr style="border-width: 4px">

	@include('gilde.includes.voortgangsBalk')

	{{-- Lid toevoegen button -> activeert het toevoegenModal  --}}
	<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
		Lid toevoegen voor {{{$onderdeel}}} (klik hier)
	</button>
	<br>
	<div class="table-responsive">
	<table class="table">
	  <thead>
			@if ($empty)
				{{-- Melding als er nog geen leden ingevuld zijn --}}
				<tr>
					<th>Geen leden ingevuld die deelnemen aan meerdere wedstrijden.<br>
							Als er geen leden toegevoegd zijn, gaan wij er automatische vanuit dat er geen indivduele leden meedoen aan meerdere wedstrijden (zodra de deadline verstreken is).</th>
				</tr>
				<thead>
			@else
				<tr>
					{{-- Kolomnamen --}}
					<th class="align-top">Naam:</th>
          <th class="align-top">Disciplines:</th>
					<th class="align-top">Opties</th>
					</tr>
		  </thead>
		  <tbody>
					@foreach ($leden as $lid)
		    <tr>
					{{-- Gebruikergegevens --}}
		      <td>{{{$lid->naam}}}</td>
          <td>{{{$lid->disciplines}}}</td>

					<td>
					{!! Form::open(['url' => route('gilde.inschrijffomulier.deelname-meerdere-wedstrijden.Verwijderen'), 'method' => 'POST']) !!}

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

<div class="btn-group"><a href="{{route('gilde.inschrijffomulier.vendelen')}}" ><button class="btn btn-secondary" type="button" name="button">Vorige</button></a></div>
<div class="btn-group"><a href="{{route('gilde.dashboard')}}" ><button  class="btn btn-primary" type="button" name="button">Beeïndigen & terug naar hoofdscherm</button></a></div>
<br>
</div>
@endsection
