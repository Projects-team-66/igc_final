import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioReporte1');
const tabla = document.getElementById('tablaReporte1');
const btnBuscar = document.getElementById('btnBuscar');

// Inicializar DataTable
const datatable = new DataTable('#tablaReporte1', {
    data: null,
    language: lenguaje,
    pageLength: 10,
    lengthMenu: [10, 25, 50, 100],
    columns: [
        {
            title: 'No.',
            data: null,
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        { title: 'Alumno', data: 'nombre_completo' }, // Cambiado
        { title: 'Grado', data: 'grado' }, // Cambiado
        { title: 'Sección', data: 'seccion' }, // Cambiado
        { title: 'Curso', data: 'curso' }, // Cambiado
        { title: 'Asistencia', data: 'asistencia' }, // Cambiado
        {
            title: 'Acciones',
            data: null,
            searchable: false,
            orderable: false,
            render: (data, type, row) => {
                return `<button class='btn btn-warning pdf' data-profesor_id="${data.profesor_id}">PDF</button>`;
            }
        },
    ]
});

// Función para buscar los reportes de asistencia
const buscarAsistencia = async () => {
    const seccion_id = document.getElementById('reporte_asis_seccion').value; // Cambiado

    if (!seccion_id) {
        Swal.fire({
            title: "Campo vacío",
            text: "Debe seleccionar una sección",
            icon: "info"
        });
        return;
    }

    try {
        const url = `/igc_final/API/reporte_asistencia/buscar?grado_id=${grado_id}&seccion_id=${seccion_id}`;
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

btnBuscar.addEventListener('click', buscarAsistencia);
