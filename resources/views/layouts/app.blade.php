<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Aplicación Laravel')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
