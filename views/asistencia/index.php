<h1 class="text-center">Registro de Asistencia</h1>
<div class="container">
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioAsistencia">
            <input type="hidden" name="asistencia_id" id="asistencia_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="asistencia_alumno">Seleccione un Alumno</label>
                    <select name="asistencia_alumno" id="asistencia_alumno" class="form-control">
                        <option value="">Seleccione un alumno</option>
                        <?php foreach ($alumnos as $alumno) : ?>
                            <option value="<?php echo $alumno->alumno_id; ?>"><?php echo $alumno->alumno_nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="asistencia_curso">Seleccione un Cruso</label>
                    <select name="asistencia_curso" id="asistencia_curso" class="form-control">
                        <option value="">Seleccione un curso</option>
                        <?php foreach ($cursos as $curso) : ?>
                            <option value="<?php echo $curso->curso_id; ?>"><?php echo $curso->curso_nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="asistencia_fecha">Fecha</label>
                    <input type="date" name="asistencia_fecha" id="asistencia_fecha" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="asistencia_estado">Selecione</label>
                    <select name="asistencia_estado" id="asistencia_estado" class="form-control" required>
                        <option value="">SELECCIONE...</option>
                        <option value="PRESENTE">PRESENTE</option>
                        <option value="AUSENTE">AUSENTE</option>
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <button type="submit" form="formularioAsistencia" id="btnGuardar" class="btn btn-primary btn-block">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning btn-block">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info btn-block">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger btn-block">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <h1>Datatable de Asistencia</h1>
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="tablaAsistencia" class="table table-bordered table-hover">
                <!-- Contenido de la tabla aquí -->
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/asistencia/index.js') ?>"></script>
