<?php
function listarConEnlaces($ruta)
{
    echo "<h3>Contenido de la carpeta $ruta:</h3><ul>";
    $dirReal = __DIR__ . "/../../" . $ruta;
    $archivos = is_dir($dirReal) ? scandir($dirReal) : [];

    foreach ($archivos as $archivo) {
        if ($archivo == "." || $archivo == "..") continue;

        $enlace = "#";
        if (strpos($archivo, 'Publico.html') !== false) {
            $enlace = "/" . $archivo;
        } elseif (strpos($archivo, 'Privado.html') !== false) {
            $enlace = "/pagina%20Personal/" . $archivo;
        } elseif ($ruta == "public/misPhps" && strpos($archivo, '.php') !== false) {
            $enlace = "/misPhps/" . $archivo;
        }

        echo "<li><a href='$enlace'>$archivo</a></li>";
    }
    echo "</ul>";
}

listarConEnlaces("public");
listarConEnlaces("public/practica");
listarConEnlaces("public/misPhps");
?>

<h3>Selecciona qué archivo quieres ejecutar</h3>
<form action="ejecutarArchivo.php" method="POST">
    <select name="archivo_orden">
        <option value="/misPhp/miPrimeraPagina.php">/misPhp/miPrimeraPagina.php</option>
        <option value="/misPhp/misArchivos.php">/misPhp/misArchivos.php</option>
    </select>
    <button type="submit">Ejecutar</button>
</form>