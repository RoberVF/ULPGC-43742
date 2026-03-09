<!DOCTYPE html>
<html lang="es">

<head>
    <title>ECOMARKET</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.nav')
    <main>
        @yield('content')
    </main>
    @include('components.footer')
</body>

</html>
