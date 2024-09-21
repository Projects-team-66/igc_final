import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioAlumnos');
const tabla = document.getElementById('tablaAlumnos');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

let datatable = new DataTable('#tablaAlumnos', {
    data: null,
    language: lenguaje,
    pageLength: 15,
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        { title: 'No.', data: 'id', width: '2%', render: (data, type, row, meta) => meta.row + 1 },
        { title: 'Nombre', data: 'alumno_nombre' },
        { title: 'Apellido', data: 'alumno_apellido' },
        { title: 'Nacimiento', data: 'alumno_fecha_nacimiento' },
        { title: 'Dirección', data: 'alumno_direccion' },
        { title: 'Teléfono', data: 'alumno_telefono' },
        { title: 'Email', data: 'alumno_email' },
        {
            title: 'Acciones', data: 'id', render: (data, type, row) => `
            <button class='btn btn-warning modificar' data-id="${data}" data-nombre="${row.alumno_nombre}" data-apellido="${row.alumno_apellido}"
                data-fecha_nacimiento="${row.alumno_fecha_nacimiento}" data-direccion="${row.alumno_direccion}"
                data-telefono="${row.alumno_telefono}" data-email="${row.alumno_email}">
                <i class='bi bi-pencil-square'></i>Modificar
            </button>
            <button class='btn btn-danger eliminar' data-id="${data}">Eliminar</button>
        ` }
    ]
});

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

const guardar = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario, ['alumno_id'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/alumnos/guardar";
        const config = { method: 'POST', body };
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje } = data;
        if (codigo == 1) {
            Toast.fire({ icon: 'success', title: mensaje });
            formulario.reset();
            buscar();
        } else {
            Toast.fire({ icon: 'error', title: mensaje });
        }
    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {
    try {
        const url = "/igc_final/API/alumnos/buscar";
        const respuesta = await fetch(url);
        const data = await respuesta.json();
        const { datos } = data;
        datatable.clear().draw();
        if (datos) datatable.rows.add(datos).draw();
    } catch (error) {
        console.log(error);
    }
};

const traerDatos = (e) => {
    const elemento = e.currentTarget.dataset;
    formulario.alumno_id.value = elemento.id;
    formulario.alumno_nombre.value = elemento.nombre;
    formulario.alumno_apellido.value = elemento.apellido;
    formulario.alumno_fecha_nacimiento.value = elemento.fecha_nacimiento;
    formulario.alumno_direccion.value = elemento.direccion;
    formulario.alumno_telefono.value = elemento.telefono;
    formulario.alumno_email.value = elemento.email;
    btnGuardar.parentElement.style.display = 'none';
    btnModificar.parentElement.style.display = '';
    btnCancelar.parentElement.style.display = '';
};

const cancelar = () => {
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.parentElement.style.display = 'none';
};

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
        const url = "/igc_final/API/alumnos/modificar";
        const config = { method: 'POST', body };
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje } = data;
        if (codigo == 1) {
            Toast.fire({ icon: 'success', title: mensaje });
            buscar();
            cancelar();
        } else {
            Toast.fire({ icon: 'error', title: mensaje });
        }
    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (e) => {
    const id = e.currentTarget.dataset.id;
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
            body.append('id', id);
            const url = "/igc_final/API/alumnos/eliminar";
            const config = { method: 'POST', body };
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje } = data;
            if (codigo == 1) {
                buscar();
            }
            Toast.fire({ icon: codigo == 1 ? 'success' : 'error', title: mensaje });
        } catch (error) {
            console.log(error);
        }
    }
};

formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);
document.addEventListener('click', (e) => {
    if (e.target.matches('.eliminar')) eliminar(e);
    if (e.target.matches('.modificar')) traerDatos(e);
});

buscar();
