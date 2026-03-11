document.addEventListener('DOMContentLoaded', () => {
    let tempChart, humChart;

    const renderChart = (ctx, label, data, color) => {
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(i => new Date(i.measured_at).toLocaleTimeString()),
                datasets: [{
                    label: label,
                    data: data.map(i => i.value),
                    borderColor: color,
                    backgroundColor: color.replace('1)', '0.1)'),
                    fill: true,
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    };

    const actualizarGraficos = async () => {
        const dni = document.getElementById('sensor_id_graf').value;
        
        try {
            const response = await fetch(`/api/sensors/${dni}`);
            const allData = await response.json();

            const tempData = allData.filter(item => item.type === 'temperature').reverse();
            const humData = allData.filter(item => item.type === 'humidity').reverse();

            if (tempChart) tempChart.destroy();
            if (humChart) humChart.destroy();

            tempChart = renderChart(
                document.getElementById('tempChart').getContext('2d'),
                'Temperatura (°C)', tempData, 'rgba(239, 68, 68, 1)'
            );
            
            humChart = renderChart(
                document.getElementById('humChart').getContext('2d'),
                'Humedad (%)', humData, 'rgba(59, 130, 246, 1)'
            );
        } catch (e) {
            console.error("Error cargando gráficos:", e);
        }
    };

    document.getElementById('btn-actualizar').addEventListener('click', actualizarGraficos);
    actualizarGraficos();
});