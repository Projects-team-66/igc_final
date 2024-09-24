<h1 class="text-center">Bienvenido a Inscripcion de Alumnos</h1>
<h2 class="text-center">Asigne un Alumno a su Seccion y Grado Correspondiente</h2>
    <div class="row justify-content-center mb-5">
    <form id="formularioAsignacionAlumno" class="border shadow p-4 col-lg-10">
            <input type="hidden" name="asignacion_id" id="asignacion_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="asignacion_alumno">Seleccione un Alumno</label>
                    <select name="asignacion_alumno" id="asignacion_alumno" class="form-control">
                        <option value="">Alumnos...</option>
                        <?php foreach ($alumnos as $alumno) : ?>
                            <option value="<?= $alumno['alumno_id'] ?>"> <?= $alumno['alumno_nombre'] ?> <?= $alumno['alumno_apellido'] ?></option>';
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="asignacion_seccion">Seleccione una Seccion y Grado</label>
                    <select name="asignacion_seccion" id="asignacion_seccion" class="form-control">
                        <option value="">Secciones...</option>
                        <?php foreach ($secciones as $seccion) : ?>
                            <option value="<?= $seccion['seccion_id'] ?>"> <?= $seccion['grado_nombre'] ?> <?= $seccion['seccion_nombre'] ?></option>';
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <h1>ALUMNOS ASIGNADOS A SUS SECCIONES</h1>
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="tablaAsignacionAlumno" class="table table-bordered table-hover">
                <!-- Contenido de la tabla aquí -->
            </table>
        </div>
    </div>
<script src="<?= asset('./build/js/asignacionalumno/index.js') ?>"></script>