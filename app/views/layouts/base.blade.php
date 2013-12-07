<!doctype html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title')
        <title>iZGOK - igrivi zgodovinski kviz</title>
    @show
    @section('head')
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @show
</head>
<body>
    @yield('body')
    @section('javascript')
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @show
</body>
</html>