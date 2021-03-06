<!DOCTYPE html>
<html lang="{{ config('app.locale', 'ja') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', '無停電システム') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @section('stylesheet')
    @show
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="app">
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>