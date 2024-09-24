document.addEventListener('DOMContentLoaded', function() {
    const btnGenerarPdf = document.querySelector('#generarPdf');
    
    btnGenerarPdf.addEventListener('click', function() {
        const pagoMes = document.querySelector('#pago_mes').value;

        // Validar que se haya seleccionado un mes
        if (pagoMes === '#') {
            alert('Por favor, seleccione un mes válido');
            return;
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
