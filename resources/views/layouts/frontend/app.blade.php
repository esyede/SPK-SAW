<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site_title', 'App Name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .register-photo {
            background: #f1f7fc;
            padding: 80px 0
        }

        .register-photo .image-holder {
            display: table-cell;
            width: auto;
            background: url(https://images.unsplash.com/photo-1535957998253-26ae1ef29506?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=436&q=80);
            background-size: cover
        }

        .register-photo .form-container {
            display: table;
            max-width: 900px;
            width: 90%;
            margin: 0 auto;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1)
        }

        .register-photo form {
            display: table-cell;
            width: 400px;
            background-color: #ffffff;
            padding: 40px 60px;
            color: #505e6c
        }

        @media (max-width:991px) {
            .register-photo form {
                padding: 40px
            }
        }

        .register-photo form h2 {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 30px
        }

        .register-photo form .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid #dfe7f1;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            text-indent: 0px;
            height: 40px
        }

        .register-photo form .form-check {
            font-size: 13px;
            line-height: 20px
        }

        .register-photo form .already {
            display: block;
            text-align: left;
            font-size: 12px;
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none
        }

        .btn-success{
            background: #567CDD !important;
            border: 1px solid #567CDD !important;
        }

        .btn-success:hover{
            background: #4A73DA !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('vendor.lara-izitoast.toast')
</body>
</html>
