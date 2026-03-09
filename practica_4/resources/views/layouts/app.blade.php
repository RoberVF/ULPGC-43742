<!DOCTYPE html>
<html lang="es">

<head>
    <title>ECOMARKET</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="mb-4">
        @include('components.nav')
    </div>
    <main>
        @yield('content')
    </main>
    <div class="mt-4">
        @include('components.footer')
    </div>
</body>

</html>
