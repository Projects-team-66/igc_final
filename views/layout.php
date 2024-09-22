<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="icon" href="<?= asset('images/pop.jpg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Instituto Guatemalteco Central</title>
    <style>
        /* Estilo para el cuerpo */
        body {
            background-color: #3c2f2f;
            font-family: 'Arial', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        /* Estilo para el navbar */
        .navbar-custom {
            background-color: #2b1f1f;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        .navbar-brand {
            font-size: 3rem;
            color: #fff;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ddd;
            transition: color 0.4s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #a88f5f;
        }

        .dropdown-menu {
            background-color: #4e3b3b;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #a88f5f;
        }

        .container-fluid {
            padding: 15px;
        }

        footer {
            color: #ddd;
            text-align: center;
            padding: 10px 0;
        }

        .progress-bar {
            background-color: #a88f5f;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/igc_final/">
                <!-- <img src="<?= asset('images/escudo1.png') ?>" width="35" alt="Logo"> -->
                I G C
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/igc_final/"><i class="bi bi-house-fill me-2"></i> Inicio</a>
                    </li>
  
                    <div class="nav-item dropdown " >
                        <a class="nav-link dropdown-toggle" href="/igc_final/profesores" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>PROFESORES
                        </a>
                        <ul class="dropdown-menu" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/profesores"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>REGISTRO DE PROFESORES</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/asistencia"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>ASISTENCIA DE ALUMNOS</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/pdfconductas"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>GENERAR REPORTE CONDUCTA</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/actividades"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>INGRESAR ACTIVIDADES</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/pdfasistencias"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>GENERAR REPORTE ASISTENCIA</a>
                              
                                <a class="dropdown-item" href="/aplicaciones/nueva"><i class="bi bi-plus-circle me-2"></i>Registro</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-fingerprint"></i> Tutores
                        </a>
                        <ul class="dropdown-menu" style="margin: 0;">
                            <li>
                                <a class="dropdown-item" href="/igc_final/tutor"><i class="bi bi-person-plus"></i> Registro</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="/igc_final/profesores" data-bs-toggle="dropdown">
                            <i class="bi bi-person-video3"></i> Profesores
                        </a>
                        <ul class="dropdown-menu" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/profesores"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>REGISTRO DE PROFESORES</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/asistencia"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>ASISTENCIA DE ALUMNOS</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/pdfconductas"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>GENERAR REPORTE CONDUCTA</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/actividades"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>INGRESAR ACTIVIDADES</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/igc_final/pdfasistencias"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>GENERAR REPORTE ASISTENCIA</a>
                            </li>
                        </ul>
                                  
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-robot"></i> Administracion
                        </a>
                        <ul class="dropdown-menu" style="margin: 0;">
                            <li>
                                <a class="dropdown-item" href="/igc_final/grado"><i class="bi bi-clipboard2-check"></i> Grados</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/igc_final/seccion"><i class="bi bi-clipboard2-check-fill"></i> Secciones</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/igc_final/grados"><i class="bi bi-person-check-fill"></i> Asignación Alumnos</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/igc_final/grados"><i class="bi bi-briefcase-fill"></i> Asignación Profesores</a>
                            </li>
                        </ul>
                    </div>
                </ul>

                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <a href="/menu/" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i> MENÚ</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid" id="contenidoPrincipal">
        <?php echo $contenido; ?>
    </div>

    <!-- Pie de página -->
    <footer>
        Comando de Informática y Tecnología, <?= date('Y') ?> &copy;
    </footer>

    <!-- Barra de progreso inferior -->
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated" id="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbarHeight = document.querySelector('.navbar').offsetHeight;
            document.getElementById('contenidoPrincipal').style.marginTop = navbarHeight + 'px';
        });
    </script>
</body>

</html>