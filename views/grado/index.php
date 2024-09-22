<h1 class="text-center">Bienvenido Registre el Nuevo Grado</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioGrado" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="grado_id" id="grado_id">
        <div class="row mb-5">
            <div class="col">
                <label for="grado_nombre">Nombre del Grado</label>
                <input type="text" name="grado_nombre" id="grado_nombre" class="form-control">
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
<h2 class="text-center mb-4">Grados Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaGrado">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/grado/index.js') ?>"></script>