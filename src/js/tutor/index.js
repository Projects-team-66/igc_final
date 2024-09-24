import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioTutor');
const tabla = document.getElementById('tablaTutor');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

let contador = 1;

const datatable = new DataTable('#tablaTutor', {
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'tutor_id',
            width: '2%',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre',
            data: 'tutor_nombre'
        },
        {
            title: 'Apellido',
            data: 'tutor_apellido'
        },
        {
            title: 'Telefono',
            data: 'tutor_telefono'
        },
        {
            title: 'Email',
            data: 'tutor_email'
        },
        {
            title: 'Direccion',
            data: 'tutor_direccion'
        },
        {
            title: 'Relacion',
            data: 'tutor_relacion'
        },
        {
            title: 'Acciones',
            data: 'tutor_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                    <button class='btn btn-warning modificar' 
                        data-tutor_id="${data}" 
                        data-tutor_nombre="${row.tutor_nombre}" 
                        data-tutor_apellido="${row.tutor_apellido}" 
                        data-tutor_telefono="${row.tutor_telefono}" 
                        data-tutor_email="${row.tutor_email}" 
                        data-tutor_direccion="${row.tutor_direccion}" 
                        data-tutor_relacion="${row.tutor_relacion}">
                        <i class='bi bi-pencil-square'></i>Modificar
                    </button>
                    <button class='btn btn-danger eliminar' data-tutor_id="${data}">Eliminar</button>`;
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

    if (!validarFormulario(formulario, ['tutor_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/tutor/guardar";
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
        const url = "/igc_final/API/tutor/buscar";
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
    } catch (error) {
        console.log(error);
    }
};
buscar();

const traerDatos = (e) => {
    const elemento = e.currentTarget.dataset;

    formulario.tutor_id.value = elemento.tutor_id;
    formulario.tutor_nombre.value = elemento.tutor_nombre;
    formulario.tutor_apellido.value = elemento.tutor_apellido;
    formulario.tutor_telefono.value = elemento.tutor_telefono;
    formulario.tutor_email.value = elemento.tutor_email;
    formulario.tutor_direccion.value = elemento.tutor_direccion;
    formulario.tutor_relacion.value = elemento.tutor_relacion;
    tabla.parentElement.parentElement.style.display = 'none';

    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.parentElement.style.display = '';
    btnModificar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    btnCancelar.disabled = false;
};

const cancelar = () => {
    tabla.parentElement.parentElement.style.display = '';
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnGuardar.disabled = false;
    btnModificar.parentElement.style.display = 'none';
    btnModificar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
};

const modificar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/tutor/modificar";
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
};

const eliminar = async (e) => {
    const tutor_id = e.currentTarget.dataset.tutor_id;

    let confirmacion = await Swal.fire({
        icon: 'question',
        title: 'Confirmacion',
        text: '¿Está seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    });

    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('tutor_id', tutor_id);
            const url = "/igc_final/API/tutor/eliminar";
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
};

formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);
datatable.on('click', '.modificar', traerDatos);
datatable.on('click', '.eliminar', eliminar);
