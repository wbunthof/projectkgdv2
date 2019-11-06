{{--  #
      # Code van Wouter
      #
      # --}}

@extends('gilde.layouts.app')

@section('content')
<div class="text-justify-center container">
	<br>
	<h2>{{{ucfirst($onderdeel)}}}</h2>
	<hr style="border-width: 4px">

	@include('gilde.includes.voortgangsBalk')

  <h3>Leden</h3>
  @include('gilde.includes.formTableLeden')

  <h3>Vervolgvragen</h3>
  @include('gilde.includes.formVragen')

  @include('gilde.includes.VolgendeVorigeButton')
</div>




<br>
<br>
_
@endsection
