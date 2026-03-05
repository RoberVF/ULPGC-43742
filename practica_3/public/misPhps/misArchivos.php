<?php
function listarDirectorio($ruta) {
    echo "<h3>Contenido de la carpeta $ruta:</h3><ul>";
    // Ajustamos la ruta para subir niveles desde public/misPhp/
    $dirReal = __DIR__ . "/../../" . $ruta;
    if (is_dir($dirReal)) {
        $archivos = scandir($dirReal);
        foreach ($archivos as $archivo) {
            if ($archivo !== "." && $archivo !== "..") {
                echo "<li>$archivo" . (is_dir($dirReal . "/" . $archivo) ? " (dir)" : "") . "</li>";
            }
        }
    }
    echo "</ul>";
}

listarDirectorio("public");
listarDirectorio("public/practica");
listarDirectorio("public/misPhps");
?>