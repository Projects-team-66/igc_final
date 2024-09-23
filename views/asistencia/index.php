<h1 class="text-center">Registro de Asistencia</h1>
<div class="row justify-content-center mb-5">
    <form id="formularioAsistencia" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="asistencia_id" id="asistencia_id">
        <div class="row mb-3">
            <div class="col">
                <label for="asistencia_alumno">Seleccione un Alumno</label>
                <select name="asistencia_alumno" id="asistencia_alumno" class="form-control">
                    <option value="">Seleccione un alumno</option>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <option value="<?= $alumno['alumno_id'] ?>"> <?= $alumno['alumno_nombre'] ?> <?= $alumno['alumno_apellido'] ?></option>';
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
        <div class="row mb-6">
            <div class="col-md mb-2">
                <label for="asistencia_fecha">Fecha</label>
                <input type="date" name="asistencia_fecha" id="asistencia_fecha" class="form-control" required>
            </div>
            <div class="col-md mb-2">
                <label for="asistencia_estado">Selecione</label>
                <select name="asistencia_estado" id="asistencia_estado" class="form-control" required>
                    <option value="">SELECCIONE...</option>
                    <option value="PRESENTE">PRESENTE</option>
                    <option value="AUSENTE">AUSENTE</option>
                </select>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <button type="submit" form="formularioAsistencia" id="btnGuardar" class="btn btn-success w-100"> <i class="bi bi-save"></i> Guardar</button>
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
<h1 class="text-center">Asistencia de los Alumnos</h1>
<div class="row justify-content-center">
    <div class="col table-responsive">
        <table id="tablaAsistencia" class="table table-bordered table-hover">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/asistencia/index.js') ?>"></script>