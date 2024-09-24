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
use Controllers\PagoController;
use Controllers\ReporteAsistenciaController;
use Controllers\AsignacionAlumnoController;
use Controllers\DetalleController;
use Controllers\AsignacionProfesorController;
use Controllers\CursoController;
use Controllers\PDFController;
use Controllers\ReporteConductaController;
use Controllers\LoginController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

//login
$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/menu', [LoginController::class, 'menu']);
$router->get('/profesor', [LoginController::class, 'profesor']);
$router->get('/tutor', [LoginController::class, 'tutor']);
$router->get('/registro', [LoginController::class, 'registro']);
$router->post('/API/registro', [LoginController::class, 'registroAPI']);
$router->post('/API/login', [LoginController::class, 'loginAPI']);


//ALUMNO
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

//PAGOS
$router->get('/pago', [PagoController::class, 'index']);
$router->get('/API/pago/buscar', [PagoController::class, 'buscarAPI']);
$router->post('/API/pago/guardar', [PagoController::class, 'guardarAPI']);
$router->post('/API/pago/modificar', [PagoController::class, 'modificarAPI']);
$router->post('/API/pago/eliminar', [PagoController::class, 'eliminarAPI']);


//REPORTE DE ASISTENCIA
$router->get('/reporte_asistencia', [ReporteAsistenciaController::class, 'index']);
$router->get('/API/reporte-asistencia/buscar', [ReporteAsistenciaController::class, 'buscarAPI']);

//ASIGNACION ALUMNOS
$router->get('/asignacionalumno', [AsignacionAlumnoController::class, 'index']);
$router->get('/API/asignacionalumno/buscar', [AsignacionAlumnoController::class, 'buscarAPI']);
$router->post('/API/asignacionalumno/guardar', [AsignacionAlumnoController::class, 'guardarAPI']);
$router->post('/API/asignacionalumno/modificar', [AsignacionAlumnoController::class, 'modificarAPI']);
$router->post('/API/asignacionalumno/eliminar', [AsignacionAlumnoController::class, 'eliminarAPI']);


//ASIGNACION PROFESORES
$router->get('/asignacionprofesor', [AsignacionProfesorController::class, 'index']);
$router->get('/API/asignacionprofesor/buscar', [AsignacionProfesorController::class, 'buscarAPI']);
$router->post('/API/asignacionprofesor/guardar', [AsignacionProfesorController::class, 'guardarAPI']);
$router->post('/API/asignacionprofesor/modificar', [AsignacionProfesorController::class, 'modificarAPI']);
$router->post('/API/asignacionprofesor/eliminar', [AsignacionProfesorController::class, 'eliminarAPI']);

//REPORTE DE CONDUCTA
$router->get('/reporteconducta', [ReporteConductaController::class, 'index']);
$router->get('/API/reporteconducta/buscar', [ReporteConductaController::class, 'buscarAPI']);
$router->post('/API/reporteconducta/guardar', [ReporteConductaController::class, 'guardarAPI']);
$router->post('/API/reporteconducta/modificar', [ReporteConductaController::class, 'modificarAPI']);
$router->post('/API/reporteconducta/eliminar', [ReporteConductaController::class, 'eliminarAPI']);

//REGISTRO CURSOS
$router->get('/curso', [CursoController::class, 'index']);
$router->get('/API/curso/buscar', [CursoController::class, 'buscarAPI']);
$router->post('/API/curso/guardar', [CursoController::class, 'guardarAPI']);
$router->post('/API/curso/modificar', [CursoController::class, 'modificarAPI']);
$router->post('/API/curso/eliminar', [CursoController::class, 'eliminarAPI']);

//GENERAR PDF
$router->post('/API/generarPDF', [PDFController::class, 'pdf']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

//GRAFICA
$router->get('/API/grafica/estadistica', [DetalleController::class,'detalleEnviosAPI']);


