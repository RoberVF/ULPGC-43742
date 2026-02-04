<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de {{ $nombre }}</title>
    <link rel="stylesheet" href="{{ asset('css/grupo1.css') }}">
</head>
<body>
    @include('components.navbar')

    <main>
        <h1>Perfil de: {{ $nombre }}</h1>
        <hr>

        @if(isset($contenido))
            {!! $contenido !!}
        @else
            @yield('content')
        @endif
    </main>

    @include('components.footer')
</body>
</html>