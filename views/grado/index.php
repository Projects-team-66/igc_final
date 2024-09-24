<h1 class="text-center">Bienvenido Registre el Nuevo Grado</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioGrado" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="grado_id" id="grado_id">
        <div class="row mb-5">
            <div class="col">
                <label for="grado_nombre">Nombre del Grado</label>
                <input type="text" name="grado_nombre" id="grado_nombre" class="form-control">
            </div>
            <div class="col">
                <label for="grado_monto" class="form-label">Selecciones Monto</label>
                <select name="grado_monto" id="grado_monto" class="form-control">
                    <option value="#">Seleccione Monto Según Grado</option>
                    <option value="200">Q.200.00 (PRIMERO PRIMARIA)</option>
                    <option value="400">Q.400.00 (SEGUNDO PRIMARIA)</option>
                    <option value="800">Q.800.00 (TERCERO PRIMARIA)</option>
                    <option value="1000">Q.1000.00 (CUARTO PRIMARIA)</option>
                    <option value="1200">Q.1200.00 (QUINTO PRIMARIA)</option>
                    <option value="1400">Q.1400.00 (SEXTO PRIMARIA)</option>
                </select>
            </div>
        </div>
        <div class="row mb-5">
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
<h2 class="text-center mb-4">Grados Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaGrado">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/grado/index.js') ?>"></script>