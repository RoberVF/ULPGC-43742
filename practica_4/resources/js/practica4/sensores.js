document.addEventListener('DOMContentLoaded', () => {
    const soloLocal = document.getElementById('soloLocal');
    const botones = document.querySelectorAll('.sensor-btn');
    const logArea = document.getElementById('log-textarea');
    
    const sincronizarBotones = () => {
        botones.forEach(btn => {
            btn.disabled = !soloLocal.checked;
        }); 
    };

    soloLocal.addEventListener('change', sincronizarBotones);
    sincronizarBotones();

    document.getElementById('borrar').addEventListener('click', () => {
        logArea.value = "";
    });

    document.getElementById('añadir1vez').addEventListener('click', () => {
        añadirEntradaLog();
    });

    document.getElementById('añadirNveces').addEventListener('click', () => {
        const n = parseInt(document.getElementById('repetirNveces').value) || 1;
        const incremento = parseFloat(document.getElementById('incrementoValor').value) || 0;
        let valorBase = parseFloat(document.getElementById('valor').value) || 0;

        for (let i = 0; i < n; i++) {
            añadirEntradaLog(valorBase);
            valorBase += incremento;
        }
    });

    function añadirEntradaLog(valorSobrescribir = null) {
        const id = document.getElementById('sensor_id').value;
        const valor = valorSobrescribir !== null ? valorSobrescribir : document.getElementById('valor').value;
        const fecha = document.getElementById('fecha').value;
        const hora = document.getElementById('hora').value;

        const baseUrl = window.location.origin + "/api/sensors/update";
        const params = `?seller_dni=${id}&value=${valor}&date=${fecha}&time=${hora}`;
        
        logArea.value += `POST ${baseUrl}${params}\n`;
        logArea.scrollTop = logArea.scrollHeight;
    }
});