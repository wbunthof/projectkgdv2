{{--  #
      # Code van Wouter
      #
      # --}}

@isset($vorige)
    <div class="btn-group"><a href="{{ route('gilde.inschrijfformulier', ['formonderdeel' => $vorige]) }}" ><button class="btn btn-secondary" type="button" name="button">Vorige</button></a></div>
    
@else
    <div class="btn-group"><a href="{{route('gilde.dashboard')}}" ><button  class="btn btn-secondary" type="button" name="button">Terug naar hoofdscherm</button></a></div>
@endisset

@isset($volgende)
    <div class="btn-group"><a href="{{ route('gilde.inschrijfformulier', ['formonderdeel' => $volgende]) }}" ><button  class="btn btn-primary" type="button" name="button">Volgende</button></a></div>
    
@else
    <div class="btn-group"><a href="{{route('gilde.dashboard')}}" ><button  class="btn btn-primary" type="button" name="button">Beeïndigen & terug naar hoofdscherm</button></a></div>
    
@endisset
    
