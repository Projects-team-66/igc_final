<h1 class="text-center">Bienvenido Registre la Nueva Seccion</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioSeccion" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="seccion_id" id="seccion_id">
        <div class="row mb-3">
            <div class="col">
                <label for="seccion_nombre">Nombre de Seccion</label>
                <input type="text" name="seccion_nombre" id="seccion_nombre" class="form-control">
            </div>
            <div class="col">
                    <label for="seccion_grado">Seleccione un Grado</label>
                    <select name="seccion_grado" id="seccion_grado" class="form-control">
                        <option value="">Grados...</option>
                        <?php foreach ($grados as $grado) : ?>
                            <option value="<?= $grado['grado_id'] ?>"> <?= $grado['grado_nombre'] ?></option>';
                        <?php endforeach; ?>
                    </select>
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
<h2 class="text-center mb-4">Secciones Registradas</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaSeccion">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/seccion/index.js') ?>"></script>