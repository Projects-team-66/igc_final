import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioCurso');
const tabla = document.getElementById('tablaCurso');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

let contador = 1;

const datatable = new DataTable('#tablaCurso', {
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'curso_id',
            width: '2%',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Curso',
            data: 'curso_nombre'
        },
        {
            title: 'Descripcion',
            data: 'curso_descripcion'
        },
        {
            title: 'Creditos',
            data: 'curso_creditos'
        },
        {
            title: 'Acciones',
            data: 'curso_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                    <button class='btn btn-warning modificar' 
                        data-curso_id="${data}" 
                        data-curso_nombre="${row.curso_nombre}"
                        data-curso_descripcion="${row.curso_descripcion}"
                        data-curso_creditos="${row.curso_creditos}">
                        <i class='bi bi-pencil-square'></i>Modificar
                    </button>
                    <button class='btn btn-danger eliminar' data-curso_id="${data}">Eliminar</button>`;
            }
        }
    ]
});

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

const guardar = async (e) => {
    btnGuardar.disabled = true,
    e.preventDefault();

    if (!validarFormulario(formulario, ['curso_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        })
        btnGuardar.disabled = false
        return
    }

    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/curso/guardar";
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
            btnGuardar.disabled = false
        } else {
            btnGuardar.disabled = false
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
    btnGuardar.disabled = false
};

const buscar = async () => {
    try {
        const url = "/igc_final/API/curso/buscar";
        const config = {
            method: 'GET'
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { datos } = data; 

        datatable.clear().draw(); 

        if (datos) {
            datatable.rows.add(datos).draw(); 
        }
    } catch (error) {
        console.log(error);
    }
};
buscar();

const traerDatos = (e) => {
    const elemento = e.currentTarget.dataset;

    formulario.curso_id.value = elemento.curso_id;
    formulario.curso_nombre.value = elemento.curso_nombre;
    formulario.curso_descripcion.value = elemento.curso_descripcion;
    formulario.curso_creditos.value = elemento.curso_creditos;
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
        const url = "/igc_final/API/curso/modificar";
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
    const curso_id = e.currentTarget.dataset.curso_id;
    console.log("ID a eliminar:", curso_id); 

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
            body.append('curso_id', curso_id);
            const url = "/igc_final/API/curso/eliminar";
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
