<style>
  /* Estilos generales */
  body {
    background-color: #3c2f2f; /* Tono oscuro similar al fondo de la imagen */
    color: #fff; /* Texto en color blanco para contraste */
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
  }

  /* Estilo para la cabecera */
  h1 {
    font-size: 2.5em;
    font-weight: bold;
    color: #F5DEB3; /* Color dorado suave que combina con el diseño del escudo */
    margin-bottom: 20px;
  }

  /* Centrado del contenido */
  .row {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  /* Estilo para el div que contiene la imagen */
  .col img {
    border: 5px solid #a88f5f; /* Borde que hace juego con los tonos del escudo */
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  /* Ajustes para pantallas pequeñas */
  @media (max-width: 768px) {
    h1 {
      font-size: 2em;
    }

    .col img {
      width: 90%;
    }
  }
</style>

<!-- Contenido del cuerpo -->
<div class="row mb-3">
  <div class="col text-center">
    <h1>VISTA DE ADMINISTRADOR</h1>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col text-center">
    <img src="./images/escudo.jpg" width="80%" alt="Escudo del Instituto">
  </div>
</div>

<script src="build/js/inicio.js"></script>
