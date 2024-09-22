<h1 class="text-center">Bienvenido Registre la Nueva Seccion</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioSeccion" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="seccion_id" id="seccion_id">
        <div class="row">
            <div class="col">
                <label for="tutor_nombre">Nombre de Seccion</label>
                <input type="text" name="tutor_nombre" id="tutor_nombre" class="form-control">
            </div>
            <div class="col">
                <label for="tutor_apellido">Seleccione Grado</label>
                <input type="text" name="tutor_apellido" id="tutor_apellido" class="form-control">
            </div>
        </div>
        <div class="row mb-5">
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
<h2 class="text-center mb-4">Tutores Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaTutor">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/tutor/index.js') ?>"></script>