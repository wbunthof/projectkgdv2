{{--  #
      # Code van Wouter
      #
      # --}}

@extends('admin.layouts.app')

@section('content')
  <div class='container'> <!-- trigger modal voor het toeveogen van gilden-->
	<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal">
	  Gilden toevoegen
	</button>
</div>
<br>
<!-- Modal voor het toevoegen van gilden -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gilden toevoegen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'form', 'url' => route('admin.gilde.nieuw'), 'method' => 'POST']) !!}

        {!! Form::hidden('_method', 'put') !!}
        {!! Form::token() !!}

        {!! Form::number('NBFS nummer', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'nummer', 'placeholder' => 'NBFS']) !!}
        {!! Form::text('Gildenaam', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'naam', 'placeholder' => 'Naam van het gilde']) !!}
        {!! Form::text('E-mailadres', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'email', 'placeholder' => 'E-mailadres van de secretaris']) !!}
        {!! Form::text('Locatie', '', ['class' => 'form-control mb-2 mr-sm-2', 'name' => 'locatie', 'placeholder' => 'Locatie waar het gilde gevestigd is']) !!}

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
				 <th scope="col" id="tableNBFS"><button type="button" class="btn" onclick="sortNBFS()">NBFS</button></th>
	       <th scope="col" id="tableNaam"><button type="button" class="btn" onclick="sortNaam()">Gildenaam</button></th>
	       <th scope="col" id="tableEmail"><button type="button" class="btn" onclick="sortEmail()">E-mailadres</button></th>
				 <th scope="col" id="tableLocatie"><button type="button" class="btn" onclick="sortLocatie()">Locatie</button></th>
				 <th scope="col">Acties</th>
	     </tr>
	   </thead>
	   <tbody id="tableData">
  @php
    $i = 0;
  @endphp
  @foreach ($gilden as $gilde)
    <tr> <!-- rij 2-->
			        <th scope='row'>{{$gilde->id}}</th>
			        <td>{{$gilde->name}}</td>
			        <td>{{$gilde->email}}</td>
							<td>{{$gilde->name}}</td>
			 			 <td>
			 				 <div class='btn-group dropleft'>
			 			  		 	<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			 			    			Actie
			 			  			</button>
			 			  			<div class='dropdown-menu'>
			 								<a class='dropdown-item' href='#ModalChangeMail{{$gilde->id}}' data-toggle='modal'>E-mailadres bewerken</a>
                      {!! Form::open(['url' => route('admin.gilde.nieuwWachtwoord'), 'method' => 'POST']) !!}

                      {!! Form::hidden('_method', 'put') !!}
                      {!! Form::hidden('id', $gilde->id) !!}
                      {!! Form::token() !!}

                      {!! Form::submit('Nieuw wachtwoord', ['class' => 'dropdown-item']) !!}

                      {!! Form::close() !!}

                      {!! Form::open(['url' => route('admin.gilde.verwijderen'), 'method' => 'POST']) !!}

                      {!! Form::hidden('_method', 'delete') !!}
                      {!! Form::hidden('id', $gilde->id) !!}
                      {!! Form::token() !!}

                      {!! Form::submit('Verwijderen', ['class' => 'dropdown-item']) !!}

                      {!! Form::close() !!}
                      <!--<a class='dropdown-item' href='http://localhost/admin/gilde/verwijderen/{{$gilde->id}}'>Verwijderen</a>-->


			 			  			</div>
			 						</div>
									</div>
									<div class='modal fade' id='ModalChangeMail{{$gilde->id}}'data-target='#ModalChangeMail' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
									  <div class='modal-dialog' role='document'>
									    <div class='modal-content'>
									      <div class='modal-header'>
									        <h5 class='modal-title' id='exampleModalLabel'>Verander e-mailadres</h5>
									        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									          <span aria-hidden='true'>&times;</span>
									        </button>
									      </div>
									      <div class='modal-body'>
													<form class='form-inline'action='includes.gilde/changemail.php?changemail={{$gilde->id}}' method='POST'>
														<div class='form-group'>
									 					 <label class='sr-only' for='inlineFormInputEmail'>Nieuw e-mailadres</label>
									 				   <input name='email' type='email' class='form-control mr-sm-2' id='email' placeholder='E-mailadres'>
									 				 </div>

													  <!-- <a href='bewerken.gilde.php?changemail=1'> -->
														 <button type='submit' name='submit' class='btn btn-primary'>Opslaan</button>
													  <!--</a> -->
														<!--<button type='button' class='btn btn-secondary' data-dismiss='modal'>Annuleren</button> -->

													</form>
												</div>
									    </div>
									  </div>
									</div>
									</div
			 				 </div>
			 		 	 </td>
			      </tr

    @php
      $i++;
    @endphp
  @endforeach
</tbody>
</table>
</div>
</div>

@endsection
