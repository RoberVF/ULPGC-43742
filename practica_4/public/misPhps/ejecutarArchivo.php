<?php
if (isset($_POST['archivo_orden'])) {
    echo "La orden a ejecutar es " . htmlspecialchars($_POST['archivo_orden']);
} else {
    echo "No existe ninguna orden a ejecutar";
}
