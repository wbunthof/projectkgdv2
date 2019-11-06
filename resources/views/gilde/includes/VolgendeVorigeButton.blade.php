{{--  #
      # Code van Wouter
      #
      # --}}
@php
if (false !== $key = array_search(str_replace(' ', '-', strtolower($onderdeel)), $volgordePaginaZonderOpmaak)) {
  if ($key == 0) {
    $hrefVolgende = route('gilde.inschrijffomulier.' . str_replace(' ', '-', $volgordePagina[$key + 1]));
    echo '<div class="btn-group"><a href="'.$hrefVolgende.'" ><button  class="btn btn-primary" type="button" name="button">Volgende</button></a></div> ';

  } elseif ($key == array_key_last($volgordePagina)) {
    $hrefVorige = route('gilde.inschrijffomulier.' . str_replace(' ', '-', $volgordePagina[$key - 1]));
    echo '<div class="btn-group"><a href="'.$hrefVorige.'" ><button class="btn btn-secondary" type="button" name="button">Vorige</button></a></div> ';

  } else {
    $hrefVorige = route('gilde.inschrijffomulier.' . str_replace(' ', '-', $volgordePagina[$key - 1]));
    $hrefVolgende = route('gilde.inschrijffomulier.' . str_replace(' ', '-', $volgordePagina[$key + 1]));
    echo '<div class="btn-group"><a href="'.$hrefVorige.'" ><button class="btn btn-secondary" type="button" name="button">Vorige</button></a></div> ';
    echo '<div class="btn-group"><a href="'.$hrefVolgende.'" ><button  class="btn btn-primary" type="button" name="button">Volgende</button></a></div> ';
  }
}
echo '';
@endphp
