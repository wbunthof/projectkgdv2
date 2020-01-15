{{--  #
      # Code van Wouter
      #
      # --}}

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">{{config('app.name', 'Kringgildedag')}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('raadsheer.dashboard') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('raadsheer.dashboard') }}">Dashboard</a>
            </li>
                <li class="nav-item dropdown">
                <a id="navbarDropdownInschrijfformulier" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Inschrijfformulier <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach(Auth::user()->formonderdelen()->get() as $onderdeel)
                        <a class="dropdown-item" href="{{ route('raadsheer.onderdeel', ['id' => $onderdeel->id]) }}">{{ ucfirst($onderdeel->onderdeel) }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
      <!-- Rechterkant van de Navbar -->
      <ul class="navbar-nav navbar-right">
           <li class="nav-item dropdown">
              <a id="navbarDropdownEigenPagina" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
      </ul>
    </div>
  </div>
</nav>
