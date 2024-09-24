document.addEventListener('DOMContentLoaded', function() {
    const btnGenerarPdf = document.querySelector('#generarPdf');
    
    btnGenerarPdf.addEventListener('click', function() {
        const pagoMes = document.querySelector('#pago_mes').value;

        // Validar que se haya seleccionado un mes
        if (pagoMes === '#') {
            alert('Por favor, seleccione un mes válido');
            return;
import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioSolvencia');
const tabla = document.getElementById('tablaSolvencia');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

let contador = 1;

const datatable = new DataTable('#tablaSolvencia', {
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'matricula_id',
            width: '2%',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Alumno',
            data: 'alumno_nombre'
        },
        {
            title: 'Curso',
            data: 'curso_nombre'
        },
        {
            title: 'Fecha',
            data: 'matricula_fecha'
        },
        {
            title: 'Estado',
            data: 'matricula_estado'
        },
        {
            title: 'Acciones',
            data: 'matricula_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                     <button class='btn btn-warning modificar' 
        data-matricula_id="${data}" 
        data-alumno_id="${row.alumno_nombre}" 
        data-curso_id="${row.curso_nombre}" 
        data-matricula_fecha="${row.matricula_fecha}" 
        data-matricula_estado="${row.matricula_estado}">
        <i class='bi bi-pencil-square'></i>
    </button>
    <button class='btn btn-danger eliminar' data-matricula_id="${data}">
        <i class='bi bi-trash'></i>
    </button>
`;
            }
        }
    ]
});

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['matricula_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/solvencia/guardar";
        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();
            buscar();
        } else {
            icon = 'error';
            console.log(detalle);
        }

        Toast.fire({
            icon: icon,
            title: mensaje
        });

    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {
    try {
        const url = "/igc_final/API/solvencia/buscar";
        const config = {
            method: 'GET'
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { datos } = data; // Obtén los datos correctamente

        datatable.clear().draw(); // Limpia la tabla antes de añadir los nuevos datos

        if (datos) {
            datatable.rows.add(datos).draw(); // Añade los datos a la tabla y dibuja
        }

        // Crear un objeto FormData para enviar el mes seleccionado
        const datos = new FormData();
        datos.append('pago_mes', pagoMes);

        // Realizar la petición al servidor para generar el PDF
        fetch('/solvencia/generarPdf', {
            method: 'POST',
            body: datos
        })
        .then(response => {
            if (response.ok) {
                // Abrir el PDF en una nueva ventana
                window.open('/solvencia/generarPdf', '_blank');
            } else {
                alert('Hubo un error al generar el PDF');
            }
        })
        .catch(error => {
            console.error('Error al generar el PDF:', error);
        });
    });
});
