import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioReporte1');
const tabla = document.getElementById('tablaReporte1');
const btnBuscar = document.getElementById('btnBuscar');

let contador = 1;

// Inicializar el DataTable para mostrar los reportes de asistencia
const datatable = new DataTable('#tablaReporte1', {
    data: null,
    language: lenguaje,
    pageLength: 10,
    lengthMenu: [10, 25, 50, 100],
    columns: [
        {
            title: 'No.',
            data: 'reporte_asistencia_id',
            width: '2%',
            render: (data, type, row, meta) => {
                // console.log(meta.ro);
                return meta.row + 1;
            }
        },
        { title: 'Alumno', data: 'alumno_nombre' },
        { title: 'Grado', data: 'grado_nombre' },
        { title: 'Sección', data: 'seccion_nombre' },
        { title: 'Curso', data: 'curso_nombre' },
        { title: 'Asistencia', data: 'asistencia_estado' },
        {
            title: 'Acciones',
            data: 'profesor_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                let html = `
                <button class='btn btn-warning pdf' data-profesor_id="${data}">PDF </button>
            `;
            
                return html;
            }
        },
    ]
});

// Función para buscar los reportes de asistencia en función del grado y la sección seleccionados
const buscarAsistencia = async () => {
    const grado_id = document.getElementById('reporte_asis_grado').value;
    const seccion_id = document.getElementById('reporte_asis_seccion').value;

    if (!grado_id || !seccion_id) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe seleccionar un grado y una sección",
            icon: "info"
        });
        return;
    }

    try {
        const url = `/igc_final/API/asistencia/buscar?grado_id=${grado_id}&seccion_id=${seccion_id}`;
        const respuesta = await fetch(url, { method: 'GET' });
        const data = await respuesta.json();

        const { codigo, mensaje, datos } = data;

        if (codigo === 1) {
            datatable.clear().rows.add(datos).draw();
        } else {
            Swal.fire({
                title: "Error",
                text: mensaje,
                icon: "error"
            });
        }
    } catch (error) {
        console.error(error);
        Swal.fire({
            title: "Error",
            text: "Hubo un problema al obtener los datos",
            icon: "error"
        });
    }
}

// Event listeners
btnBuscar.addEventListener('click', buscarAsistencia);

