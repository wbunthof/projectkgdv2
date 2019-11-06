@foreach ($vragen as $vraag)
	@if ($vraag->extraInfo)
		{{--  Modal met extra info, komt omhoog als er op de info knop wordt gedrukt--}}
		<div class="modal fade" id="modal{{$vraag->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{{$vraag->tekst}}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{!!$vraag->extraInfo!!}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	@endif

	@php $antwoord = "";	@endphp
	@php if(array_key_exists($vraag->id, $antwoorden)){$antwoord = $antwoorden[$vraag->id];} @endphp
	<div class="form-group" id="{{$vraag->id}}">
	@if ($vraag->type === 'B') <!-- Vraag met een boolean type -> ja/nee -->
		@php
		switch ($antwoord) {
			case '1':
				$antwoord1 = true;
				$antwoord0 = false;
				break;

			case '0':
				$antwoord1 = false;
				$antwoord0 = true;
				break;

			default:
				$antwoord1 = false;
				$antwoord0 = false;
				break;
		} @endphp
		<label for="{{$vraag->id}}">{{$vraag->tekst}}
			@if ($vraag->extraInfo)
				<span class="fas fa-info-circle" data-toggle="modal" data-target="#modal{{$vraag->id}}"> </span> {{-- Info button met extra uitleg --}}
			@endif
		</label>
		<br>
		<div class="form-group btn-group btn-group-toggle" data-toggle="buttons" name="{{$vraag->id}}">
			<label class="btn btn-secondary @if ($antwoord0)bg-success @endif"  @if (!$readonly)onclick="this.classList.add('bg-success'); this.parentNode.getElementsByTagName('label')[1].classList.remove('bg-success');"@endif>
				<input 	type="radio"
								name="{{$vraag->id}}"
								value="0"
								@if ($vraag->verplicht) required	@endif
							  @if (!$readonly) onchange="vraagOpslaanBoolean(this, '{{$urlVraagOpslaan}}', '{{csrf_token()}}')" @endif
								@if ($readonly)
									readonly
								@endif
								>Nee
				</input>
			</label>
			<label class="btn btn-secondary @if ($antwoord1)bg-success @endif" @if (!$readonly) onclick="this.classList.add('bg-success'); this.parentNode.getElementsByTagName('label')[0].classList.remove('bg-success'); "@endif>
				<input 	type="radio"
								name="{{$vraag->id}}"
								value="1" @if ($vraag->verplicht) required	@endif
								@if (!$readonly) onchange="vraagOpslaanBoolean(this, '{{$urlVraagOpslaan}}', '{{csrf_token()}}')" @endif
								@if ($readonly)
									readonly
								@endif
								>Ja
				</input>
				{{-- {!! Form::radio($vraag->id, 1, $antwoord1, ['required']) !!} Ja --}}
			</label>
		</div>

	@elseif ($vraag->type === 'Koningschieten') <!-- Vraag met een boolean type -> Geweer/Kruisboog/nee -->
			@php
			// 1
			switch ($antwoord) {
				case 'Geweerschieten':
					$antwoord2 = false;
					$antwoord1 = true;
					$antwoord0 = false;
					break;

				case 'Kruisboogschieten':
					$antwoord2 = false;
					$antwoord1 = false;
					$antwoord0 = true;
					break;

				case 'Nee':
					$antwoord2 = true;
					$antwoord1 = false;
					$antwoord0 = false;
					break;

				default:
					$antwoord2 = false;
					$antwoord1 = false;
					$antwoord0 = false;
					break;
			} @endphp
			<label for="{{$vraag->id}}">{{$vraag->tekst}}
				@if ($vraag->extraInfo)
					<span class="fas fa-info-circle" data-toggle="modal" data-target="#modal{{$vraag->id}}"> </span> {{-- Info button met extra uitleg --}}
				@endif
			</label>
			<br>
			<div class="form-group btn-group btn-group-toggle" data-toggle="buttons" name="{{$vraag->id}}">
				<label class="btn btn-secondary @if ($antwoord0)bg-success @endif"  @if (!$readonly)onclick="this.classList.add('bg-success'); this.parentNode.getElementsByTagName('label')[1].classList.remove('bg-success'); this.parentNode.getElementsByTagName('label')[2].classList.remove('bg-success');"@endif>
					<input 	type="radio"
									name="{{$vraag->id}}"
									value="Kruisboogschieten"
									@if($vraag->verplicht)required @endif
								  @if (!$readonly)onchange="vraagOpslaanBoolean(this, '{{$urlVraagOpslaan}}', '{{csrf_token()}}')"@endif
									@if ($readonly)
										readonly
									@endif
									>Kruisboogschieten
					</input>
				</label>
				<label class="btn btn-secondary @if ($antwoord1)bg-success @endif" @if (!$readonly) onclick="this.classList.add('bg-success'); this.parentNode.getElementsByTagName('label')[0].classList.remove('bg-success'); this.parentNode.getElementsByTagName('label')[2].classList.remove('bg-success');"@endif>
					<input 	type="radio"
									name="{{$vraag->id}}"
									value="Geweerschieten"
									@if ($vraag->verplicht) required	@endif
								  @if (!$readonly)onchange="vraagOpslaanBoolean(this, '{{$urlVraagOpslaan}}', '{{csrf_token()}}')"@endif
									@if ($readonly)
										readonly
									@endif
									>Geweerschieten
					</input>
					{{-- {!! Form::radio($vraag->id, 1, $antwoord1, ['required']) !!} Ja --}}
				</label>
				<label class="btn btn-secondary @if ($antwoord2)bg-success @endif"  @if (!$readonly)onclick="this.classList.add('bg-success'); this.parentNode.getElementsByTagName('label')[0].classList.remove('bg-success'); this.parentNode.getElementsByTagName('label')[1].classList.remove('bg-success');"@endif>
					<input 	type="radio"
									name="{{$vraag->id}}"
									value="Nee"
									@if ($vraag->verplicht) required	@endif
								 	@if (!$readonly) onchange="vraagOpslaanBoolean(this, '{{$urlVraagOpslaan}}', '{{csrf_token()}}')" @endif
									@if ($readonly)
										readonly
									@endif
									>Nee
									</input>
					{{-- {!! Form::radio($vraag->id, 1, $antwoord1, ['required']) !!} Ja --}}
				</label>
			</div>

	@elseif ($vraag->type === 'N') <!-- Vraag met een nummer type -->
		<div >{{$vraag->tekst}}
			@if ($vraag->extraInfo) <span class="fas fa-info-circle" data-toggle="modal" data-target="#modal{{$vraag->id}}"></span> {{-- Info button met extra uitleg --}}	@endif
			<span style="float: right" >
				@if (!empty($vraag->minimumValue)) Minimaal: {{$vraag->minimumValue}} @endif
				@if (!empty($vraag->maximumValue)) Maximaal: {{$vraag->maximumValue}} @endif
			</span>
		</div>
		</label>
		{!! Form::text($vraag->id, $antwoord, ['readonly', 'data-fout' => 'false', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => $vraag->placeholder, 'min' => $vraag->minimumValue, 'max' => $vraag->maximumValue,'onkeyup' => 'nummerChecker(this)', 'onblur' => 'vraagOpslaanNummer(this, "'. $urlVraagOpslaan .'", "' . csrf_token() . '")']) !!}

	@elseif ($vraag->type === 'T') <!-- Vraag met een tekst type -->
		<label for="{{$vraag->id}}">{{$vraag->tekst}}
			@if ($vraag->extraInfo)
				<span class="fas fa-info-circle" data-toggle="modal" data-target="#modal{{$vraag->id}}"></span> {{-- Info button met extra uitleg --}}
			@endif
		</label>
		{!! Form::text($vraag->id, $antwoord, ['readonly', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => $vraag->placeholder, 'minlength' => $vraag->minimumValue, 'maxlength' => $vraag->maximumValue, 'onblur' => 'vraagOpslaanText(this, "'. $urlVraagOpslaan .'", "' . csrf_token() . '")']) !!}

	@elseif ($vraag->type === 'TA') <!-- Vraag met een tekstarea type -->
		<label for="{{$vraag->id}}">{{$vraag->tekst}}
			@if ($vraag->extraInfo)
				<span class="fas fa-info-circle" data-toggle="modal" data-target="#modal{{$vraag->id}}"> </span> {{-- Info button met extra uitleg --}}
			@endif
		</label>
		{!! Form::textarea($vraag->id, $antwoord, ['readonly', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => $vraag->placeholder, 'minlength' => $vraag->minimumValue, 'maxlength' => $vraag->maximumValue, 'onblur' => 'vraagOpslaanText(this, "'. $urlVraagOpslaan .'", "' . csrf_token() . '")']) !!}




	@endif
	</div>
@endforeach
