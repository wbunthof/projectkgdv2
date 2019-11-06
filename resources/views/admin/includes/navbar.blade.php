{{--  #
      # Code van Wouter
      #
      # --}}

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('gilde.dashboard')}}">{{config('app.name', 'Kringgildedag')}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
  		<li class="nav-item {{ Route::currentRouteNamed('admin.gilde.bewerken') ? 'active' : '' }}">
  			<a class="nav-link" href="{{route('admin.gilde.weergeven')}}">Gildes bewerken</a>
  		</li>

  		<li class="nav-item {{ Route::currentRouteNamed('admin.raadsheer.bewerken') ? 'active' : '' }}">
  			<a class="nav-link disabled" href="{{'#' /*route('admin.raadsheer.weergeven')*/}}">Raadsheren bewerken</a>
  		</li>

  		<li class="nav-item {{ Route::currentRouteNamed('admin.organiser.bewerken') ? 'active' : '' }}">
  			<a class="nav-link disabled" href="{{'#' /*route('admin.organiser.weergeven')*/}}">Organiserend gilde bewerken</a>
  		</li>
      </ul>
      <ul class="nav navbar-nav float-right">
        <li class="nav-item dropdown">
            <a id="navbarDropdownEigenPagina" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.dashboard')}}">Hoofdscherm</a>
                <a class="dropdown-item" href="{{ route('admin.account')}}">Account</a>
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
</nav>
