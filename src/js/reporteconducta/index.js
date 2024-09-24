import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('formularioReporteConducta');
const tabla = document.getElementById('tablaReporteConducta')
const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')

let contador = 1;
btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;



const datatable = new DataTable('#tablaReporteConducta', {
    data: null,
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'reporte_conducta_id',
            width: '2%',
            render: (data, type, row, meta) => {
                // console.log(meta.ro);
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre Completo',
            data: 'reporte_alumno'
        },
        {
            title: 'Grado',
            data: 'grado_nombre'
        }, {
            title: 'Seccion',
            data: 'seccion_nombre'
        },
        {
            title: 'Conducta',
            data: 'reporte_conducta'
        },
        {
            title: 'Fecha',
            data: 'reporte_fecha'
        },
        {
            title: 'Acciones',
            data: 'reporte_conducta_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                let html = `
                <button class='btn btn-warning modificar' data-reporte_conducta_id="${data}" data-reporte_alumno="${row.reporte_alumno}" data-grado_nombre="${row.grado_nombre}" data-seccion_nombre="${row.seccion_nombre}" data-reporte_conducta="${row.reporte_conducta}" data-reporte_fecha="${row.reporte_fecha}">
                    <i class='bi bi-pencil-square'></i> 
                </button>
                <button class='btn btn-danger eliminar' data-reporte_conducta_id="${data}">
                  <i class='bi bi-trash'></i> 
                </button>
            `;

                return html;
            }
        },

    ]
}
);


btnModificar.parentElement.style.display = 'none'
btnModificar.disabled = true
btnCancelar.parentElement.style.display = 'none'
btnCancelar.disabled = true



const guardar = async (e) => {
    btnGuardar.disabled = true,
        e.preventDefault()

    if (!validarFormulario(formulario, ['reporte_conducta_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        })
        btnGuardar.disabled = false
        return
    }

    try {
        const body = new FormData(formulario)
        const url = "/igc_final/API/reporteconducta/guardar"
        const config = {
            method: 'POST',
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        if (codigo == 1) {
            icon = 'success'
            formulario.reset();
            buscar();
            btnGuardar.disabled = false
        } else {
            btnGuardar.disabled = false
            icon = 'error'
            console.log(detalle);
        }

        Toast.fire({
            icon: icon,
            title: mensaje
        })

    } catch (error) {
        console.log(error);
    }
    btnGuardar.disabled = false
}



const buscar = async () => {
    try {

        const url = "/igc_final/API/reporteconducta/buscar"
        const config = {
            method: 'GET',
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle, datos } = data;
        console.log(datos);
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
    const elemento = e.currentTarget.dataset

    formulario.profesor_id.value = elemento.profesor_id
    formulario.profesor_nombre.value = elemento.profesor_nombre
    formulario.profesor_apellido.value = elemento.profesor_apellido
    formulario.profesor_telefono.value = elemento.profesor_telefono
    formulario.profesor_email.value = elemento.profesor_email
    formulario.profesor_direccion.value = elemento.profesor_direccion
    tabla.parentElement.parentElement.style.display = 'none'

    btnGuardar.parentElement.style.display = 'none'
    btnGuardar.disabled = true
    btnModificar.parentElement.style.display = ''
    btnModificar.disabled = false
    btnCancelar.parentElement.style.display = ''
    btnCancelar.disabled = false
}

const cancelar = () => {
    tabla.parentElement.parentElement.style.display = ''
    formulario.reset();
    btnGuardar.parentElement.style.display = ''
    btnGuardar.disabled = false
    btnModificar.parentElement.style.display = 'none'
    btnModificar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
}



const modificar = async (e) => {
    e.preventDefault()

    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        })
        return
    }

    try {
        const body = new FormData(formulario)
        const url = "/igc_final/API/reporteconducta/modificar"
        const config = {
            method: 'POST',
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        console.log(data);
        let icon = 'info'
        if (codigo == 1) {
            icon = 'success'
            formulario.reset();
            buscar();
            cancelar();
        } else {
            icon = 'error'
            console.log(detalle);
        }

        Toast.fire({
            icon: icon,
            title: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}


const eliminar = async (e) => {
    const reporte_conducta_id = e.currentTarget.dataset.reporte_conducta_id

    //console.log("ID a eliminar:", reporte_conducta_id); // Agrega esta línea
    let confirmacion = await Swal.fire({
        icon: 'question',
        title: 'Confirmacion',
        text: '¿Esta seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // input: 'text'
    })
    console.log(confirmacion);
    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData()
            body.append('reporte_conducta_id', reporte_conducta_id)
            const url = "/igc_final/API/reporteconducta/eliminar"
            const config = {
                method: 'POST',
                body
            }

            const respuesta = await fetch(url, config);
            const data = await respuesta.json(); // Obtener la respuesta como texto
            

            const {codigo, mensaje, detalle} = data;

            let icon = 'info'
            if (codigo === 1) {
                icon = 'success'
                formulario.reset();
                buscar();
            } else {
                icon = 'error'
                console.log(detalle);
            }

            Toast.fire({
                icon: icon,
                title: mensaje
            })
        } catch (error) {
            console.log(error);
        }
    }

}

formulario.addEventListener('submit', guardar)
btnCancelar.addEventListener('click', cancelar)
btnModificar.addEventListener('click', modificar)
datatable.on('click', '.modificar', traerDatos)
datatable.on('click', '.eliminar', eliminar)