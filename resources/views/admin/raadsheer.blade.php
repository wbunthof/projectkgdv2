{{--  #
      # Code van Wouter
      #
      # --}}

@extends('admin.layouts.app')

@section('content')
  <div class='container'> <!-- trigger modal voor het toevoegen van raadsheren-->
	<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
	  Raadsheer toevoegen
	</button>
</div>
<br>
<!-- Modal voor het toevoegen van raadsheren -->
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
        {!! Form::open(['class' => 'form', 'url' => route('admin.raadsheer.create'), 'method' => 'POST']) !!}

        {!! Form::hidden('_method', 'put') !!}
        {!! Form::token() !!}

        {!! Form::text('Naam', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'name', 'placeholder' => 'Naam', 'required']) !!}
        {!! Form::email('E-mailadres', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'email', 'placeholder' => 'E-mailadres van de Raadsheer', 'required']) !!}
        @foreach($onderdelen as $onderdeel)
              {!! Form::checkbox($onderdeel->id, 1) !!}
              {{ucfirst($onderdeel->onderdeel)}}
            <br>
        @endforeach
        {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}

        {!! Form::close() !!}
    	  <br>
      </div>
    </div>
  </div>
</div>

<div class='container'> <!-- tabel met mogelijkheid om de records aan te passen of te verwijderen-->
	<div class='table-responsive'>
	 <table class="table table-bordered table-hover">
	   <thead>
	     <tr>
				 <th scope="col" id="tableNBFS"><button type="button" class="btn" onclick="sortNBFS()">Id</button></th>
	       <th scope="col" id="tableNaam"><button type="button" class="btn" onclick="sortNaam()">Raadsheernaam</button></th>
	       <th scope="col" id="tableEmail"><button type="button" class="btn" onclick="sortEmail()">E-mailadres</button></th>
				 <th scope="col" id="tableLocatie"><button type="button" class="btn" onclick="sortLocatie()">Onderdelen</button></th>
				 <th scope="col">Acties</th>
	     </tr>
	   </thead>
	   <tbody id="tableData">
  @php
    $i = 0;
  @endphp
  @foreach ($raadsheren as $raadsheer)
    <tr> <!-- rij 2-->
        <th scope='row'>{{$raadsheer->id}}</th>
        <td>{{$raadsheer->name}}</td>
        <td>{{$raadsheer->email}}</td>
        <td>
        {{-- @dump($raadsheer->formOnderdelen()->get()) --}}
            @foreach($raadsheer->formOnderdelen()->orderBy('id')->get() as $onderdeel)
                {{ ucfirst($onderdeel->onderdeel) }}
                <br>
            @endforeach
        </td>
        <td>
        <div class='btn-group dropleft'>
            <button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Actie </button>
            <div class='dropdown-menu'>
                <a class='dropdown-item' href='#ModalChange{{$raadsheer->id}}' data-toggle='modal'>Bewerken</a>
                {!! Form::open(['url' => route('admin.raadsheer.password', ['id' => $raadsheer->id]), 'method' => 'POST']) !!}

                {!! Form::hidden('_method', 'put') !!}
                {!! Form::token() !!}

                {!! Form::submit('Nieuw wachtwoord', ['class' => 'dropdown-item']) !!}

                {!! Form::close() !!}

                {!! Form::open(['url' => route('admin.raadsheer.delete', ['id' => $raadsheer->id]), 'method' => 'POST']) !!}

                {!! Form::hidden('_method', 'delete') !!}
                {!! Form::hidden('id', $raadsheer->id) !!}
                {!! Form::token() !!}

                {!! Form::submit('Verwijderen', ['class' => 'dropdown-item']) !!}

                {!! Form::close() !!}
            </div>
        </div>
        <div class='modal fade' id='ModalChange{{$raadsheer->id}}' data-target='#ModalChange' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Gegevens veranderen van {{ $raadsheer->name }}</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        {!! Form::open(['class' => 'form', 'url' => route('admin.raadsheer.update', ['id' => $raadsheer->id]), 'method' => 'POST']) !!}

                        {!! Form::hidden('_method', 'patch') !!}
                        {!! Form::token() !!}

                        {!! Form::text('E-mailadres', $raadsheer->email, ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'email', 'placeholder' => 'E-mailadres van de Raadsheer', 'required']) !!}
                        @foreach($onderdelen as $onderdeel)
                            {!! Form::checkbox($onderdeel->id, 1, $raadsheer->formOnderdelen()->where('formonderdeel_id', $onderdeel->id)->count() ? true : false) !!}
                            {{ucfirst($onderdeel->onderdeel)}}
                            <br>
                        @endforeach
                        {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary mb-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </tr>

    @php
      $i++;
    @endphp
  @endforeach
</tbody>
</table>
</div>
</div>

@endsection
