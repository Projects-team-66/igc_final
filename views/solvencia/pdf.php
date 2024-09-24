<h1>Reporte de Solvencia - Mes: <?= $mes ?></h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nombre del Alumno</th>
            <th>Grado</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Estado de Pago</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pagos as $pago) : ?>
            <tr>
                <td><?= $pago['alumno_nombre'] ?></td>
                <td><?= $pago['grado_nombre'] ?></td>
                <td><?= $pago['grado_monto'] ?></td>
                <td><?= date('d/m/Y', strtotime($pago['pago_fecha'])) ?></td>
                <td><?= $pago['pago_estado'] == 1 ? 'Pagado' : 'Pendiente' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
