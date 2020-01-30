{{--  #
      # Code van Wouter
      #
      # --}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name', 'Kringgildedag')}}</title>

        <!-- Bootstrap -->
        <link href="{{asset('css/all.php')}}" rel="stylesheet">

    </head>
    <body onload="removeMessage()">
    <script>
        function removeMessage() {
            setTimeout(
                function() {
                    var el = document.getElementsByClassName('alert-dismissible');
                    for (var i = 0; i < el.length; i++) {
                        $(el).alert('close');
                    }
                }, 3000
            );

        }
    </script>

        @include('raadsheer.includes.navbar')
        <div class="container">
          <br>
          @include('raadsheer.includes.messages')
          @yield('content')
        </div>
    </body>

    <!-- Javascript -->
    <script src="{{asset('js/all.php')}}" charset="utf-8"></script>

</html>
