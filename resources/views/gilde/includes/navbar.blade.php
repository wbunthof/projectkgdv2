{{--  #
      # Code van Wouter
      #
      # --}}
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('gilde.dashboard')}}">{{config('app.name', 'Kringgildedag')}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="{{route('gilde.dashboard')}}" class="nav-link">Hoofdscherm</a>
          </li>
          <li class="nav-item">
            <a href="{{route('gilde.account')}}" class="nav-link">Account</a>
          </li>
          <div onmouseover="this.children[0].children[0].click()" onmouseout="this.children[0].children[0].click()">
          <li class="nav-item dropdown">
            <a id="navbarDropdownInschrijfformulier" onclick="this.click()" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              Inschrijfformulier <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top: 0px">
              @foreach ($volgordePagina as $link)
                <a class="dropdown-item" onclick="this.parentNode.parentNode.children[0].disabled = 'disabled'" href="{{route('gilde.inschrijffomulier.' . str_replace(' ', '-', $link))}}">{{ucfirst($link)}}</a>
              @endforeach
            </div>
          </li>
        </div>
      </ul>

      <!-- Rechterkant van de Navbar -->
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Uitloggen') }}
          </a>
        </li>
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown" onmouseover="this.children[0].click()" onmouseout="this.children[0].click()">
                  <a id="navbarDropdownEigenPagina" onclick="this.click()" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" onclick="this.parentNode.parentNode.children[0].disabled = 'disabled'" href="{{ route('gilde.dashboard')}}">Hoofdscherm</a>
                      <a class="dropdown-item" onclick="this.parentNode.parentNode.children[0].disabled = 'disabled'" href="{{ route('gilde.account')}}">Account</a>
                      <a class="dropdown-item" onclick="this.parentNode.parentNode.children[0].disabled = 'disabled'" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Uitloggen') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
              <li class="nav-item"></li>
          @endguest
      </ul>
    </div>
  </div>
</nav>
