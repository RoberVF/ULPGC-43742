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
        const incrementoVal = parseFloat(document.getElementById('incrementoValor').value) || 0;
        const periodicidad = document.getElementById('periodicidad').value; 

        let valorBase = parseFloat(document.getElementById('valor').value) || 0;

        const fechaInput = document.getElementById('fecha').value;
        const horaInput = document.getElementById('hora').value;

        let fechaHora = new Date(`${fechaInput}T${horaInput}`);

        for (let i = 0; i < n; i++) {
            const fechaStr = fechaHora.toISOString().split('T')[0];
            const horaStr = fechaHora.toTimeString().split(' ')[0].substring(0, 5);

            añadirEntradaLog(valorBase, fechaStr, horaStr);

            valorBase += incrementoVal;

            if (periodicidad === 'minuto') {
                fechaHora.setMinutes(fechaHora.getMinutes() + 1);
            } else if (periodicidad === 'horas') {
                fechaHora.setHours(fechaHora.getHours() + 1);
            } else if (periodicidad === 'días') {
                fechaHora.setDate(fechaHora.getDate() + 1);
            }
        }
    });

    function añadirEntradaLog(valorOverride = null, fechaOverride = null, horaOverride = null) {
        const id = document.getElementById('sensor_id').value;
        const valor = valorOverride !== null ? valorOverride : document.getElementById('valor').value;
        const fecha = fechaOverride !== null ? fechaOverride : document.getElementById('fecha').value;
        const hora = horaOverride !== null ? horaOverride : document.getElementById('hora').value;

        const baseUrl = window.location.origin + "/api/sensors/update";
        const params = `?seller_dni=${id}&value=${valor.toFixed(2)}&date=${fecha}&time=${hora}`;

        logArea.value += `POST ${baseUrl}${params}\n`;
        logArea.scrollTop = logArea.scrollHeight;
    }
});