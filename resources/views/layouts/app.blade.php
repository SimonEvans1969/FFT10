@yield('php')
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

    <script src="{{ asset('js/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Buttons-1.5.4/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/Scroller-1.5.0/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('js/Select-1.2.6/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/jszip3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake0.1.54/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake0.1.54/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/modules/material-select.js') }}"></script>
    <script src="{{ asset('cdns/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Below 2 - for new multi-select -->
    <script src="{{ asset('cdns/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('cdns/bootstrap4-toggle.min.js') }}"></script>

    @include('laravelusers::scripts.toggleText')

    <!-- Fonts -->
    <!--link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <link href="{{ asset('cdns/woff.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/Chart.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Buttons-1.5.4/css/buttons.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Scroller-1.5.0/css/scroller.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Select-1.2.6/css/select.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('laravelusers.fontAwesomeCdn')) }}">
    <link rel="stylesheet" href="{{ asset('cdns/tempusdominus-bootstrap-4.min.css') }}" />
    <!-- Below 1 - for new multi-select -->
    <link rel="stylesheet" href="{{ asset('cdns/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdns/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fft/fft.css') }}?rnd=123" />
    @yield('style')
</head>
<body>
<div id="app">
    <div id="ajax-alert" class="alert" style="display:none"></div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel text-large">
        <div class="container">
            <a href="{{ url('/') }}">{{ config('app.name', 'FFT') }}</a>
            @auth
                &nbsp;/&nbsp;
                <div class="dropdown show">
                    <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @yield('viewName')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php if ( Auth::user()->role  != "DataOnly") { ?>
                        <a class="dropdown-item" href="{{ url('fft_summary') }}">Summary</a>
                        <a class="dropdown-item" href="{{ url('feedback') }}">Feedback</a>
                        <?php }; ?>
                        <a class="dropdown-item" href="{{ url('allstats') }}">Overall Stats</a>
                        <a class="dropdown-item" href="{{ url('analysis') }}">Analysis</a>
                        <?php if (( Auth::user()->role  == "Admin") || ( Auth::user()->role  == "Full")) { ?>
                        <a class="dropdown-item" href="{{ url('fullinfo') }}">Feedback (with categories)</a>
                        <?php }; ?>
                        <?php if ( Auth::user()->role  == "Admin") { ?>
                        <a class="dropdown-item" href="{{ url('words') }}">Words Analysis</a>
                        <a class="dropdown-item" href="{{ url('themes') }}">Thematic Analysis</a>
                        <?php }; ?>
                        <?php if ((Auth::user()->role != "Limited") && (Auth::user()->role != "DataOnly"))  { ?>
                        <a class="dropdown-item" href="{{ url('refdata') }}">Reference Data</a>
                        <?php }; ?>
                        <?php if ( Auth::user()->role  == "Admin") { ?>
                        <a class="dropdown-item" href="{{ url('zeros') }}">Fix Zeros</a>
                        <a class="dropdown-item" href="{{ url('chart') }}">Charts</a>
                        <a class="dropdown-item" href="{{ url('paperentry/create') }}">Paper Entry</a>
                        <a class="dropdown-item" href="{{ url('qrcodes') }}">Web Links</a>
                        <a class="dropdown-item" href="{{ url('users') }}">User Maintenance</a>
                        <?php }; ?>
                    </div>
                </div>
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   onclick="event.preventDefault(); savePrefs();">
                                    Save Preferences
                                </a>
                                <a class="dropdown-item" href="{{ url('changePassword') }}">Change Password</a>
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script type="text/javascript">
    $(window).load(function(){
        $.ajaxSetup({
            statusCode: {
                419: function(){
                    location.reload();
                }
            }
        });
        $.fn.selectpicker.Constructor.BootstrapVersion = '4';
    });

    function savePrefs() {
        var prefsData = new Object();
        $('.fft_select').each(function() {
            prefsData[$(this).attr('id')] = $(this).val();
        });
        $.ajax({
            type:'GET',
            url: '{{ route('prefs/save') }}',
            data: prefsData,
            success: function(response) {
                if(response.code === 200) {
                    $('#ajax-alert').addClass('alert-sucess').show(function(){
                        $(this).html(response.success);
                    });
                }
                if(response.code === 400){
                    $('#ajax-alert').addClass('alert-danger').show(function(){
                        $(this).html(response.success);
                    });
                }
            },
        });
    };
</script>
@yield('script')
</body>
</html>