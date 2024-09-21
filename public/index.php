<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\TutorController;
$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);



//TUTOR
$router->get('/tutor', [TutorController::class, 'index']);
$router->get('/API/tutor/buscar', [TutorController::class, 'buscarAPI']);
$router->post('/API/tutor/guardar', [TutorController::class, 'guardarAPI']);
$router->post('/API/tutor/modificar', [TutorController::class, 'modificarAPI']);
$router->post('/API/tutor/eliminar', [TutorController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
