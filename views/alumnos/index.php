<h1 class="text-center">Registro de Alumnos</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioAlumnos" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="alumno_id" id="alumno_id">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="alumno_nombre" class="form-label">Nombre del alumno</label>
                <input type="text" name="alumno_nombre" id="alumno_nombre" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="alumno_apellido" class="form-label">Apellido del Alumno</label>
                <input type="text" name="alumno_apellido" id="alumno_apellido" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="alumno_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="alumno_fecha_nacimiento" id="alumno_fecha_nacimiento" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="alumno_direccion" class="form-label">Dirección</label>
                <input type="text" name="alumno_direccion" id="alumno_direccion" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="alumno_telefono" class="form-label">Teléfono</label>
                <input type="number" name="alumno_telefono" id="alumno_telefono" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="alumno_email" class="form-label">Correo</label>
                <input type="email" name="alumno_email" id="alumno_email" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alumno_tutor">Asignar tutor</label>
                <select name="alumno_tutor" id="alumno_tutor" class="form-control">
                    <option value="#">Seleccione...</option>
                    <?php foreach ($tutores as $tutor) : ?>
                        <option value="<?= $tutor['tutor_id'] ?>"> <?= $tutor['tutor_nombre'] ?> <?= $tutor['tutor_apellido'] ?></option>';
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <button type="submit" form="formularioAlumnos" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
<h2 class="text-center mb-4">Alumnos Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaAlumnos">
        </table>
    </div>
</div>
</div>
<script src="<?= asset('./build/js/alumnos/index.js') ?>"></script>