<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FFT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/Scroller-1.5.0/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('js/Select-1.2.6/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/jszip3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <!-- Fonts -->
    <!--link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fft/fft.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Buttons-1.5.4/css/buttons.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Scroller-1.5.0/css/scroller.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Select-1.2.6/css/select.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.fontAwesomeCdn') }}">
</head>
<body>
    <div id="app">
        <div id="ajax-alert" class="alert" style="display:none"></div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel text-large">
            <div class="container">
                  <a href="{{ url('/') }}">{{ config('app.name', 'FFT') }}</a>
                  &nbsp;/&nbsp; 
                 
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Registered User
                        </div>
                    </div>
                    <div class="card-body">
                        Your account has been registered.  
                        
                        The System Administrator will contact you as soon as it has been activated.
                    </div>
                </div>
            </div>
        </main>
    </div>
    </body>
</html>
