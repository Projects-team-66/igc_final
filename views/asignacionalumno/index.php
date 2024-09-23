<h1 class="text-center">Bienvenido a Asignacion de Alumnos</h1>
<h2 class="text-center">Inscripcion de Alumnos</h2>
    <div class="row justify-content-center mb-5">
    <form id="formularioAsistencia" class="border shadow p-4 col-lg-10">
            <input type="hidden" name="asistencia_id" id="asistencia_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="asistencia_alumno">Seleccione un Alumno</label>
                    <select name="asistencia_alumno" id="asistencia_alumno" class="form-control">
                        <option value="">Seleccione un alumno</option>
                        <?php foreach ($alumnos as $alumno) : ?>
                            <option value="<?= $alumno['alumno_id'] ?>"> <?= $alumno['alumno_nombre'] ?></option>';
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="asistencia_curso">Seleccione un Cruso</label>
                    <select name="asistencia_curso" id="asistencia_curso" class="form-control">
                        <option value="">Seleccione un curso</option>
                        <?php foreach ($cursos as $curso) : ?>
                            <option value="<?= $curso['curso_id'] ?>"> <?= $curso['curso_nombre'] ?></option>';
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <button type="submit" form="formularioAsistencia" id="btnGuardar" class="btn btn-primary btn-block">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning btn-block">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info btn-block">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger btn-block">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <h1>Datatable de Asistencia</h1>
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="tablaAsistencia" class="table table-bordered table-hover">
                <!-- Contenido de la tabla aquí -->
            </table>
        </div>
    </div>
<script src="<?= asset('./build/js/asistencia/index.js') ?>"></script>