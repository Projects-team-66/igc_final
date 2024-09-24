<h1 class="text-center">Registro de Cursos</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioCurso" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="curso_id" id="curso_id">
        <div class="row mb-5">
            <div class="col">
                <label for="curso_nombre">Nombre del curso</label>
                <input type="text" name="curso_nombre" id="curso_nombre" class="form-control">
            </div>
            <div class="col">
                <label for="curso_descripcion">descripcion del curso</label>
                <input type="text" name="curso_descripcion" id="curso_descripcion" class="form-control">
            </div>
        </div>
        <div class="col">
                <label for="curso_creditos">creditos del curso</label>
                <input type="number" name="curso_creditos" id="curso_creditos" class="form-control">
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
<h2 class="text-center mb-4">Cursos Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaCurso">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/curso/index.js') ?>"></script>