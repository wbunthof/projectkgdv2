{{--  #
      # Code van Wouter
      #
      # --}}

@extends('gilde.layouts.app')

@section('content')
@php
	if ($onderdeel == 'kruishandboog') {
		$onderdeel = 'Kruis-handboog';
	} elseif ($onderdeel == 'junioren') {
		$onderdeel = 'Junioren & leden zonder pas';
	}
@endphp

	<!-- alert wordt gevuld zodra er op ja/nee is gedrukt-->
<div class="container" id="alertOpslaan">

</div>

<div class="text-justify-center container">
	<br>
	<h2>{{ucfirst($onderdeel)}}</h2>
	<hr style="border-width: 4px">
@include('gilde.includes.voortgangsBalk')

@if ($onderdeel === 'deelname')
	<!-- hoofdvraag: deelname (ja/nee) -->
	<p>Mijn gilde neemt deel aan de kringgildedag. Maak keuze door op ja of nee te klikken.</p>
	<div class="btn-group btn-block">
		<button type="submit" id="vraag1.1" class="btn btn-primary mr-1 mb-2  @if (isset($antwoorden[1]) && $antwoorden[1] == 1) active @endif" onclick="deelname(1, 1, {{Auth::user()->id}}, '{{ csrf_token() }}', '{{ route('gilde.inschrijffomulier.deelnameOpslaan')}}');" style="width: 200px;">Ja @if (isset($antwoorden[1]) && $antwoorden[1] == 1) (gekozen) @endif </button>
		<button type="submit" id="vraag1.0" class="btn btn-primary mr-1 mb-2 @if (isset($antwoorden[1]) && $antwoorden[1] == 0) active @endif" onclick="deelname(0, 1, {{Auth::user()->id}}, '{{ csrf_token() }}', '{{ route('gilde.inschrijffomulier.deelnameOpslaan')}}');" style="width: 200px;">Nee @if (isset($antwoorden[1]) && $antwoorden[1] == 0) (gekozen) @endif</button>
	</div>
	<hr style="border-width: 2px">
@endif

<!-- formulier deel2 met vervolgvragen -->

@include('gilde.includes.formVragen')

@include('gilde.includes.VolgendeVorigeButton')
</div>
<br>
@endsection
