<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProfesoresController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


//PROFESORES
$router->get('/profesores', [ProfesoresController::class,'index']);
$router->post('/API/profesores/guardar', [ProfesoresController::class,'guardarAPI']);
$router->get('/API/profesores/buscar', [ProfesoresController::class,'buscarAPI']);
$router->get('/API/profesores/modificar', [ProfesoresController::class,'modificarAPI']);
$router->get('/API/profesores/eliminar', [ProfesoresController::class,'eliminarAPI']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
