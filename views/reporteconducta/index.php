<h1 class="text-center">Registro de Asistencia</h1>
<div class="row justify-content-center mb-5">
    <form id="formularioReporteConducta" class="border shadow p-4 col-lg-10">
        <input type="hidden" name="reporte_conducta_id" id="reporte_conducta_id">
        <div class="row mb-3">
            <div class="col">
                <label for="reporte_alumno">Seleccione un Alumno</label>
                <select name="reporte_alumno" id="reporte_alumno" class="form-control">
                    <option value="">Seleccione un alumno</option>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <option value="<?= $alumno['alumno_id'] ?>"> <?= $alumno['alumno_nombre'] ?> <?= $alumno['alumno_apellido'] ?> <?= $seccion['seccion_id'] ?> <?= $seccion['seccion_nombre'] ?></option>';
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md mb-2">
                <label for="reporte_conducta">Conducta</label>
                <select name="reporte_conducta" id="reporte_conducta" class="form-control" required>
                    <option value="">SELECCIONE...</option>
                    <option value="MALA">MALA</option>
                    <option value="DEBE MEJORAR">DEBE MEJORAR</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="BUENA">BUENA</option>
                    <option value="EXCELENTE">EXCELENTE</option>

                </select>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <button type="submit" form="formularioAsistencia" id="btnGuardar" class="btn btn-success w-100"> <i class="bi bi-save"></i> Guardar</button>
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
<h1 class="text-center">Asistencia de los Alumnos</h1>
<div class="row justify-content-center">
    <div class="col table-responsive">
        <table id="tablaReporteConducta" class="table table-bordered table-hover">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/asistencia/index.js') ?>"></script>