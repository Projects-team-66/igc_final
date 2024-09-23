<h1 class="text-center">Solvencia</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioSolvencia" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="pago_id" id="pago_id">
        <div class="row mb-3">
            <div class="col">
                <label for="pago_mes" class="form-label">Mes</label>
                <select name="pago_mes" id="pago_mes" class="form-control">
                    <option value="#">Seleccione...</option>
                    <option value="ENERO">Enero</option>
                    <option value="FEBRERO">Febrero</option>
                    <option value="MARZO">Marzo</option>
                    <option value="ABRIL">Abril</option>
                    <option value="MAYO">Mayo</option>
                    <option value="JUNIO">Junio</option>
                    <option value="JULIO">Julio</option>
                    <option value="AGOSTO">Agosto</option>
                    <option value="SEPTIEMBRE">Septiembre</option>
                    <option value="OCTUBRE">Octubre</option>
                    <option value="NOVIEMBRE">Noviembre</option>
                    <option value="DICIEMBRE">Diciembre</option>
                </select>
            </div>
        </div>
        <div class="row text-center mb-3">
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>
</div>

<h2 class="text-center mb-4">Solvencia Registrada</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaSolvencia">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Grado</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenará la tabla con los datos -->
            </tbody>
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/solvencia/index.js') ?>"></script>
