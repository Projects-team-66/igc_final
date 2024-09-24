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

        .icon-large {
            font-size: 80px;
            text-align: center;
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
</body>

</html>