<h1 class="text-center">Registro de Pagos</h1>
<div class="row justify-content-center mb-4">
    <form id="formularioPago" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="pago_id" id="pago_id">

        <div class="row mb-3">
            <div class="col">
                <label for="pago_alumno">Alumno</label>
                <select name="pago_alumno" id="pago_alumno" class="form-control">
                    <option value="#">Seleccione...</option>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <option value="<?= $alumno['alumno_id'] ?>"><?= $alumno['alumno_nombre'] ?> <?= $alumno['alumno_apellido'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

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

        <div class="row mb-3">
            <div class="col">
                <label for="pago_fecha">Fecha</label>
                <input type="date" name="pago_fecha" id="pago_fecha" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="pago_estado" class="form-label">Estado</label>
                <select name="pago_estado" id="pago_estado" class="form-control">
                    <option value="#">Seleccione...</option>
                    <option value="SOLVENTE">Solvente</option>
                    <option value="PENDIENTE">Pendiente</option>
                </select>
            </div>
        </div>

        <div class="row text-center mb-3">
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

<h2 class="text-center mb-4">Pagos Registrados</h2>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaPago">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/pago/index.js') ?>"></script>
