<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProfesoresController;
use Controllers\AlumnoController;
use Controllers\TutorController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

//ALUMNO
$router->get('/', [AppController::class, 'index']);
$router->get('/alumnos', [AlumnoController::class, 'index']);
$router->get('/API/alumnos/buscar', [AlumnoController::class, 'buscarAPI']);
$router->post('/API/alumnos/guardar', [AlumnoController::class, 'guardarAPI']);
$router->post('/API/alumnos/modificar', [AlumnoController::class, 'modificarAPI']);
$router->post('/API/alumnos/eliminar', [AlumnoController::class, 'eliminarAPI']);

//TUTOR
$router->get('/tutor', [TutorController::class, 'index']);
$router->get('/API/tutor/buscar', [TutorController::class, 'buscarAPI']);
$router->post('/API/tutor/guardar', [TutorController::class, 'guardarAPI']);
$router->post('/API/tutor/modificar', [TutorController::class, 'modificarAPI']);
$router->post('/API/tutor/eliminar', [TutorController::class, 'eliminarAPI']);


//PROFESORES
$router->get('/profesores', [ProfesoresController::class,'index']);
$router->post('/API/profesores/guardar', [ProfesoresController::class,'guardarAPI']);
$router->get('/API/profesores/buscar', [ProfesoresController::class,'buscarAPI']);
$router->post('/API/profesores/modificar', [ProfesoresController::class,'modificarAPI']);
$router->post('/API/profesores/eliminar', [ProfesoresController::class,'eliminarAPI']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
