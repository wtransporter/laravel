<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="  sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="{{asset('css/bootstrap-material-design.css')}}">

        <script src="{{ asset('js/bootstrap-material-design.js')}}"></script>
        {{-- <script src="{{ asset('js/bootstrap-material-design.min.js')}}"></script> --}}

    </head>
    <body>
        @include('partials.navbar')
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-md-12 no-gutters">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </body>
</html>