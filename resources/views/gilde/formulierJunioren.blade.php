{{--  #
      # Code van Wouter
      #
      # --}}

@extends('gilde.layouts.app')

@section('content')
<div class="text-justify-center container">
	<br>
	<h2>Junioren & leden zonder pas	</h2>
	<hr style="border-width: 4px">

	@include('gilde.includes.voortgangsBalk')

  @include('gilde.includes.formTableJunioren')

  @include('gilde.includes.VolgendeVorigeButton')
</div>




<br>
<br>
_
@endsection
