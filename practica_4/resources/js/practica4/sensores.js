document.addEventListener('DOMContentLoaded', () => {
    const soloLocal = document.getElementById('soloLocal');
    const botones = document.querySelectorAll('.sensor-btn');
    const logArea = document.getElementById('log-textarea');
    const sensorIdInput = document.getElementById('sensor_id');

    const sincronizarBotones = () => {
        botones.forEach(btn => {
            // btn.disabled = !soloLocal.checked; 
            btn.disabled = false;
        });
    };
    soloLocal.addEventListener('change', sincronizarBotones);
    sincronizarBotones();

    document.getElementById('borrar').addEventListener('click', () => {
        logArea.value = "";
    });

    const procesarDato = async (payload) => {
        if (soloLocal.checked) {
            const baseUrl = window.location.origin + "/api/sensors";
            const params = `?seller_dni=${payload.seller_dni}&value=${payload.value}
                &type=${payload.type}&date=${payload.date}&time=${payload.time}`;
            logArea.value += `[LOCAL] POST ${baseUrl}${params}\n`;
        } else {
            try {
                const response = await fetch('/api/sensors', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                
                if (response.ok) {
                    logArea.value += `[AJAX-OK] Insertado: ${payload.value} (${payload.type}) 
                        para ${payload.seller_dni}\n`;
                } else {
                    const error = await response.json();
                    logArea.value += `[AJAX-ERROR] Servidor: ${error.message || 'Error desconocido'}\n`;
                }
            } catch (e) {
                logArea.value += `[AJAX-FATAL] No se pudo conectar con el servidor\n`;
            }
        }
        logArea.scrollTop = logArea.scrollHeight;
    };

    document.getElementById('añadir1vez').addEventListener('click', () => {
        const payload = {
            seller_dni: sensorIdInput.value,
            type: document.getElementById('nombre').value,
            value: parseFloat(document.getElementById('valor').value),
            date: document.getElementById('fecha').value,
            time: document.getElementById('hora').value
        };
        procesarDato(payload);
    });

    document.getElementById('añadirNveces').addEventListener('click', async () => {
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

            await procesarDato({
                seller_dni: sensorIdInput.value,
                type: document.getElementById('nombre').value,
                value: valorBase,
                date: fechaStr,
                time: horaStr
            });

            valorBase += incrementoVal;
            if (periodicidad === 'minuto') fechaHora.setMinutes(fechaHora.getMinutes() + 1);
            else if (periodicidad === 'horas') fechaHora.setHours(fechaHora.getHours() + 1);
            else if (periodicidad === 'días') fechaHora.setDate(fechaHora.getDate() + 1);
        }
    });

    document.getElementById('cargarSensores').addEventListener('click', async () => {
        const dni = sensorIdInput.value;
        if (!dni) return alert("Introduce un DNI");

        try {
            const response = await fetch(`/api/sensors/${dni}`);
            const data = await response.json();
            if (data.length > 0) {
                document.getElementById('nombre').value = data[0].type;
                document.getElementById('valor').value = data[0].value;
                logArea.value += `[AJAX] Formulario inicializado con datos de la BD\n`;
            }
        } catch (e) {
            logArea.value += `[AJAX-ERROR] Error al cargar sensores\n`;
        }
    });

    document.getElementById('cargarDatosSensor').addEventListener('click', async () => {
        if (soloLocal.checked) return; 
        const dni = sensorIdInput.value;
        try {
            const response = await fetch(`/api/sensors/${dni}`);
            const data = await response.json();
            logArea.value = ""; 
            data.forEach(item => {
                logArea.value += `${item.measured_at} | ${item.type}: ${item.value}\n`;
            });
        } catch (e) {
            logArea.value = "Error al recuperar histórico";
        }
    });
});