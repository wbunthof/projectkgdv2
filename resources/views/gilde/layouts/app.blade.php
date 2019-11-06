{{--  #
      # Code van Wouter
      #
      # --}}

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name', 'Kringgildedag')}}</title>

        <!-- Bootstrap -->
        <link href="{{asset('css/all.php')}}" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    </head>
    <body>

        @include('gilde.includes.navbar')
        <main role="main">
          @include('gilde.includes.messages')
          @yield('content')
          <br>
        </main>
        <footer class="footer">
          <div class="container">
            <a href="{{{ route('disclaimer')}}}">Disclaimer & privacyverklaring - &copy; Wouter Bunthof, 2019</p></a>
          </div>
        </footer>
    </body>

    <!-- Javascript -->
<script src="{{asset('js/all.php')}}" charset="UTF-8"></script>


</html>
