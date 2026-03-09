document.addEventListener('DOMContentLoaded', function() {
    const text1 = document.getElementById('text-1');
    const text2 = document.getElementById('text-2');
    const textarea = document.getElementById('main-textarea');
    const boton1 = document.getElementById('boton1');
    const boton2 = document.getElementById('boton2');
    const boton3 = document.getElementById('boton3');


    boton1.addEventListener('click', function() {
        if (text1.value.trim() !== "") {
            textarea.value += text1.value + "\n";
        }
    });

    boton2.addEventListener('click', function() {
        const segundos = parseInt(text2.value);

        if (isNaN(segundos) || segundos < 1 || segundos > 60) {
            alert("Error: Introduce un número entero entre 1 y 60.");
            return;
        }

        let contador = 0;
        const intervalId = setInterval(function() {
            if (text1.value.trim() !== "") {
                textarea.value += "(Timer: " + (contador + 1) + ") " + text1.value + "\n";
            }
            
            contador++;
            if (contador >= segundos) {
                clearInterval(intervalId);
            }
        }, 1000);
    });

    boton3.addEventListener('click', function() {
        const nuevoEstilo = text1.value.trim();
        if (nuevoEstilo !== "") {
            textarea.style.backgroundColor = nuevoEstilo;
        }
    });
});