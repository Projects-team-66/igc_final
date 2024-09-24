<div class="row justify-content-center mb-5">
    <form id="formularioAsignacionProfesor" class="border shadow p-4 col-lg-10">
        <div class="row justify-content-center mb-5">
            <i class="bi bi-person-video3 icon-large"></i>
            <h1 class="text-center">Bienvenido a Asignacion de Profesores</h1>
            <h2 class="text-center">Asigne un Profesor a la Seccion y Grado Correspondiente</h2>
        </div>
        <input type="hidden" name="profesor_seccion_id" id="profesor_seccion_id">
        <div class="row mb-3">
            <div class="col">
                <label for="profesor_sec">Seleccione una Seccion</label>
                <select name="profesor_sec" id="profesor_sec" class="form-control">
                    <option value="">Secciones...</option>
                    <?php foreach ($secciones as $seccion) : ?>
                        <option value="<?= $seccion['seccion_id'] ?>"> <?= $seccion['grado_nombre'] ?> <?= $seccion['seccion_nombre'] ?></option>';
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="profesor_prof">Seleccione un Profesor</label>
                <select name="profesor_prof" id="profesor_prof" class="form-control">
                    <option value="">Profesor...</option>
                    <?php foreach ($profesores as $profesor) : ?>
                        <option value="<?= $profesor['profesor_id'] ?>"> <?= $profesor['profesor_nombre'] ?> <?= $profesor['profesor_apellido'] ?></option>';
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <button type="submit" id="btnGuardar" class="btn btn-success w-100"> <i class="bi bi-save"></i> Guardar</button>
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
        <table id="tablaAsignacionProfesor" class="table table-bordered table-hover">
            <!-- Contenido de la tabla aquí -->
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/asignacionprofesor/index.js') ?>"></script>