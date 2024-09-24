import { Dropdown } from "bootstrap";
import Chart from "chart.js/auto";

const canvas = document.getElementById('chartEnvios');
const ctx = canvas.getContext('2d');
const btnActualizar = document.getElementById('actualizar');

const data = {
    labels: [],
    datasets: [{
        label: 'Envios',
        data: [],
        borderWidth: 5,
        backgroundColor: []
    }]
};

const chartEnvios = new Chart(ctx, {
    type: 'polarArea',
    data: data,
});

const getEstadisticas = async () => {
    const url = `/igc_final/API/detalle/estadistica`
    const config = { method: "GET" }
    const response = await fetch(url, config);
    const data = await response.json()

    if(data){
        if(chartEnvios.data.datasets[0]) {
            chartEnvios.data.labels = [];
            chartEnvios.data.datasets[0].data = [];
            chartEnvios.data.datasets[0].backgroundColor = [];
            data.forEach(r => {
                chartEnvios.data.labels.push(r.alumno_nombre);
                chartEnvios.data.labels.push(r.curso_nombre);
                chartEnvios.data.datasets[0].data.push(r.total_asistencia);
                chartEnvios.data.datasets[0].backgroundColor.push(generateRandomColor());
            });
        }
    }

    chartEnvios.update();
}

const generateRandomColor = () => {
    const r = Math.floor(Math.random() * 256); // Valor de rojo entre 0 y 255
    const g = Math.floor(Math.random() * 256); // Valor de verde entre 0 y 255
    const b = Math.floor(Math.random() * 256); // Valor de azul entre 0 y 255

    const rgbColor = `rgb(${r}, ${g}, ${b})`;
    return rgbColor;
}

btnActualizar.addEventListener('click', getEstadisticas);
