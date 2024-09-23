<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProfesoresController;
use Controllers\AlumnoController;
use Controllers\AsistenciaController;
use Controllers\TutorController;
use Controllers\SeccionController;
use Controllers\GradoController;
use Controllers\ReporteAsistenciaController;
use Controllers\AsignacionAlumnoController;

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

//GRADO
$router->get('/grado', [GradoController::class, 'index']);
$router->get('/API/grado/buscar', [GradoController::class, 'buscarAPI']);
$router->post('/API/grado/guardar', [GradoController::class, 'guardarAPI']);
$router->post('/API/grado/modificar', [GradoController::class, 'modificarAPI']);
$router->post('/API/grado/eliminar', [GradoController::class, 'eliminarAPI']);

//SECCION
$router->get('/seccion', [SeccionController::class, 'index']);
$router->get('/API/seccion/buscar', [SeccionController::class, 'buscarAPI']);
$router->post('/API/seccion/guardar', [SeccionController::class, 'guardarAPI']);
$router->post('/API/seccion/modificar', [SeccionController::class, 'modificarAPI']);
$router->post('/API/seccion/eliminar', [SeccionController::class, 'eliminarAPI']);

//PROFESORES
$router->get('/profesores', [ProfesoresController::class,'index']);
$router->get('/API/profesores/buscar', [ProfesoresController::class,'buscarAPI']);
$router->post('/API/profesores/guardar', [ProfesoresController::class,'guardarAPI']);
$router->post('/API/profesores/modificar', [ProfesoresController::class,'modificarAPI']);
$router->post('/API/profesores/eliminar', [ProfesoresController::class,'eliminarAPI']);

//ASISTENCIA
$router->get('/asistencia', [AsistenciaController::class, 'index']);
$router->get('/API/asistencia/buscar', [AsistenciaController::class, 'buscarAPI']);
$router->post('/API/asistencia/guardar', [AsistenciaController::class, 'guardarAPI']);
$router->post('/API/asistencia/modificar', [AsistenciaController::class, 'modificarAPI']);
$router->post('/API/asistencia/eliminar', [AsistenciaController::class, 'eliminarAPI']);

//REPORTE DE ASISTENCIA
$router->get('/reporte_asistencia', [ReporteAsistenciaController::class, 'index']);




//ASIGNACION ALUMNOS
$router->get('/asignacionalumno', [AsignacionAlumnoController::class, 'index']);
$router->get('/API/asignacionalumno/buscar', [AsignacionAlumnoController::class, 'buscarAPI']);
$router->post('/API/asignacionalumno/guardar', [AsignacionAlumnoController::class, 'guardarAPI']);
$router->post('/API/asignacionalumno/modificar', [AsignacionAlumnoController::class, 'modificarAPI']);
$router->post('/API/asignacionalumno/eliminar', [AsignacionAlumnoController::class, 'eliminarAPI']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
