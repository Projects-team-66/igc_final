<h1 class="text-center">Registro de Solvencia</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioSolvencia" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="matricula_id" id="matricula_id">
        <div class="row mb-3">
            <div class="col">
                <label for="matricula_alumno">Alumno</label>
                <select name="matricula_alumno" id="matricula_alumno" class="form-control">
                    <option value="#">Seleccione...</option>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <option value="<?= $alumno['alumno_id'] ?>"> <?= $alumno['alumno_nombre'] ?> <?= $alumno['alumno_apellido'] ?></option>';
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="matricula_curso">Curso</label>
                <select name="matricula_curso" id="matricula_curso" class="form-control">
                    <option value="#">Seleccione...</option>
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?= $curso['curso_id'] ?>"> <?= $curso['curso_nombre'] ?></option>';
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="matricula_fecha" class="form-label">Fecha</label>
                <input type="date" name="matricula_fecha" id="matricula_fecha" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="matricula_estado" class="form-label">Estado</label>
                <select name="matricula_estado" id="matricula_estado" class="form-control">
                <option value="#">Seleccione...</option>
                    <option value="SOLVENTE">Solvente</option>
                    <option value="PENDIENTE">Pendiente</option>
                </select>
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <button type="submit" form="formularioSolvencia" id="btnGuardar"class="btn btn-success w-100"> <i class="bi bi-save"></i> Guardar</button>
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
<h2 class="text-center mb-4">Solvencias Registradas</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaSolvencia">
        </table>
    </div>
</div>
</div>
<script src="<?= asset('./build/js/solvencia/index.js') ?>"></script>