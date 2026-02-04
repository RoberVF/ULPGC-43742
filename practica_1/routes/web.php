<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return redirect('RobertoPublico.html');
});


// Se hace asi ya que las vistas tienen que estar en el resources/views no en public
Route::get('/RobertoPublicoBlade', function () {
    return view('RobertoPublicoBlade');
});

// Para hacerlo como pide la practica
Route::get('/Roberto', function () {
    return redirect('RobertoPublico.html');
});

Route::get('/RobertoInclude', function () {
    include(public_path('RobertoPublico.html'));
});

Route::get('/RobertoPrivado', function () {
    return file_get_contents(base_path('practica/RobertoPrivado.html')); // Asi lo saco absoluto
});

// Bloque 4
Route::get('/paginaPersonal/{nombre}', function ($nombre) {
    $path = base_path("practica/{$nombre}Privado.html");

    if (!File::exists($path)) {
        abort(404, "El archivo privado de $nombre no existe en la carpeta practica.");
    }

    $htmlContent = File::get($path); // Asi saco el contenido del html

    return view('user', [
        'nombre' => $nombre,
        'contenido' => $htmlContent
    ]);
});

Route::get('/elGrupo', function () {
    return view('group');
});