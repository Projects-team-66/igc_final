<h1 class="text-center">Reporte de Asistencia</h1>
<div class="row justify-content-center mb-5">
    <form id="formularioReporte1" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="reporte_asistencia_id" id="reporte_asistencia_id">
        <div class="row mb-3">
            <div class="col">
                <label for="reporte_asis_seccion">Seleccione una Sección</label>
                <select name="reporte_asis_seccion" id="reporte_asis_seccion" class="form-control">
                    <option value="">Seleccione una sección</option>
                    <?php foreach ($secciones as $seccion) : ?>
                        <option value="<?= $seccion['seccion_id'] ?>"> <?= $seccion['grado_nombre'] ?> Sección <?= $seccion['seccion_nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-primary w-100"> <i class="bi bi-search"></i> Buscar</button>
            </div>
        </div>
    </form>
</div>
<h1 class="text-center">Reporte de Asistencia</h1>
<div class="row justify-content-center">
    <div class="col table-responsive">
        <table id="tablaReporte1" class="table table-bordered table-hover">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/reporte_asistencia/index.js') ?>"></script>