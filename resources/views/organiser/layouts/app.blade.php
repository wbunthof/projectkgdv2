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

        @include('organiser.includes.GoogleChartApi')

    </head>
    <body>

        @include('organiser.includes.navbar')
        <div class="container-fluid">
          <br>
          @include('organiser.includes.messages')
          @yield('content')
        </div>
    </body>

    <!-- Javascript -->
    <script src="{{asset('js/all.php')}}" charset="utf-8"></script>

</html>
