{{--  #
      # Code van Wouter
      #
      # --}}
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">{{config('app.name', 'Kringgildedag')}} (Organiserend gilde)</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('organiser.dashboard')}}">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="onderdeelDropdown" role="button" aria-haspopup="true" aria-expanded="false">Vragen</a>
          <div class="dropdown-menu">
            @foreach ($formonderdelen as $onderdeel)
              <a class="dropdown-item" href="{{{route('organiser.data.onderdeel', ['id' => $onderdeel->id])}}}">{{{ucfirst($onderdeel->onderdeel)}}}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="onderdeelDropdown" role="button" aria-haspopup="true" aria-expanded="false">Leden</a>
          <div class="dropdown-menu">
            @foreach ($disciplines as $discipline)
              <a class="dropdown-item" href="{{{route('organiser.data.leden', ['id' => $discipline->id])}}}">{{{ucfirst($discipline->discipline)}}}</a>
            @endforeach
            <a class="dropdown-item" href="{{{route('organiser.data.leden.deelnameMeerdereWedstrijden')}}}">Deelname Meerdere Wedstrijden</a>
            <a class="dropdown-item" href="{{{route('organiser.data.leden.zonderPas')}}}">Junioren & leden zonder pas</a>
          </div>
        </li>
          {{-- <li class="nav-item dropdown">
              <a id="navbarDropdownInschrijfformulier" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Inschrijffomrulier <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('organiser.dashboard')}}">Hoofdscherm</a>
                  <a class="dropdown-item" href="/posts/create">Create Post</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li> --}}
      </ul>
      <!-- Rechterkant van de Navbar -->
      <ul class="navbar-nav navbar-right">
          <!-- Authentication Links -->
              <li class="nav-item dropdown">
                  <a id="navbarDropdownEigenPagina" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('organiser.dashboard')}}">Home</a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
              <li class="nav-item"></li>
      </ul>
    </div>
  </div>
</nav>
