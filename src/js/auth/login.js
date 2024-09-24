import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";


const formulario = document.querySelector('form');


const iniciar = async (e) => {
    e.preventDefault()
    if (!validarFormulario(formulario)) {
        Toast.fire({
            icon: 'info',
            title: 'Debe llenar todos los campos'
        })

        return;
    }
    try {
        const body = new FormData(formulario);
        const url = "/igc_final/API/login";
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
            location.href = '/igc_final/menu'
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

formulario.addEventListener('submit', iniciar)