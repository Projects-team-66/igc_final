<h1 class="text-center">Solvencia</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioSolvencia" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="pago_id" id="pago_id">
        <div class="row mb-3">
            <div class="col">
                <label for="pago_mes" class="form-label">Mes</label>
                <select name="pago_mes" id="pago_mes" class="form-control">
                    <option value="#">Seleccione...</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
        </div>
        <div class="row text-center mb-3">
            <div class="col">
                <button type="button" id="generarPdf" class="btn btn-warning w-100">Generar PDF</button>
            </div>
        </div>
    </form>
</div>

<script src="<?= asset('./build/js/solvencia/index.js') ?>"></script>
