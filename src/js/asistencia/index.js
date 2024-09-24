import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioAsistencia');
const tabla = document.getElementById('tablaAsistencia')
const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')


let contador = 1;
btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';


const datatable = new DataTable('#tablaAsistencia', {
    data: null,
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'asistencia_id',
            width: '2%',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre Alumno',
            data: 'alumno_nombre'
        },
        {
            title: 'Apellido Alumno',
            data: 'alumno_apellido'
        },
        {
            title: 'Curso',
            data: 'curso_nombre' 
        },
        {
            title: 'Fecha',
            data: 'asistencia_fecha'
        },
        {
            title: 'Estado',
            data: 'asistencia_estado'
        },
        {
            title: 'Acciones',
            data: 'asistencia_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                let html = `
                <button class='btn btn-warning modificar' data-asistencia_id="${data}" data-alumno_id="${row.asistencia_alumno}"  data-alumno_id="${row.alumno_apellido}" data-curso_id="${row.asistencia_curso}" data-asistencia_fecha="${row.asistencia_fecha}" data-asistencia_estado="${row.asistencia_estado}">
                    <i class='bi bi-pencil-square'></i> 
                </button>
                <button class='btn btn-danger eliminar' data-asistencia_id="${data}"> 
                    <i class='bi bi-trash'></i> 
                </button>
                `;
                return html;
            }
        }
    ]
});


const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['asistencia_id'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/asistencia/guardar";
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
}


const buscar = async () => {
    try {
        const url = "/igc_final/API/asistencia/buscar";
        const config = {
            method: 'GET',
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle, datos } = data;

        datatable.clear().draw();

        if (datos) {
            datatable.rows.add(datos).draw();
        }

    } catch (error) {
        console.log(error);
    }
}
buscar();

const traerDatos = (e) => {
    const elemento = e.currentTarget.dataset;

    formulario.asistencia_id.value = elemento.asistencia_id;
    formulario.asistencia_alumno.value = elemento.alumno_id;
    formulario.asistencia_curso.value = elemento.curso_id; 
    formulario.asistencia_fecha.value = elemento.asistencia_fecha;
    formulario.asistencia_estado.value = elemento.asistencia_estado;

    tabla.parentElement.parentElement.style.display = 'none';

    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.parentElement.style.display = '';
    btnModificar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    btnCancelar.disabled = false;
}


const cancelar = () => {
    tabla.parentElement.parentElement.style.display = '';
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnGuardar.disabled = false;
    btnModificar.parentElement.style.display = 'none';
    btnModificar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
}


const modificar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/asistencia/modificar";
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
            cancelar();
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
}


const eliminar = async (e) => {
    const asistencia_id = e.currentTarget.dataset.asistencia_id;

    let confirmacion = await Swal.fire({
        icon: 'question',
        title: 'Confirmación',
        text: '¿Está seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });

    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('asistencia_id', asistencia_id);
            const url = "/igc_final/API/asistencia/eliminar";
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
    }
}

formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);
datatable.on('click', '.modificar', traerDatos);
datatable.on('click', '.eliminar', eliminar);
