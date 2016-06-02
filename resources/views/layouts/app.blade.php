<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Veg Wrap - Fazer Pedido</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="{!! asset('assets/css/custom.css') !!}" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                    <img class="logo-icon" src="data:image/png;base64,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" width="75" height="75">
                    <h1>Veg Wrap</h1>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Fazer Pedido</a></li>
                    <li><a href="{{ url('/pedidos') }}">Meus Pedidos</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{!! asset('assets/js/custom.js') !!}"></script>
</body>
</html>
