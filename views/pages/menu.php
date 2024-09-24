<h1>
  BIENVENIDO USUARIO DEL INSTITUTO GUATEMALTECO CENTRAL
</h1>

<?php if ($_SESSION['user']['rol_nombre_ct'] == 'INSTITUTO_ADMIN') : ?>
  <p>BIENVENIDO SEÑOR ADMINISTRADOR</p>
  
<?php endif ?>



<?php if ($_SESSION['user']['rol_nombre_ct'] == 'PROFESOR') : ?>
  <p>BIENVENIDO PROFESOR</p>
<?php endif ?>




<?php if ($_SESSION['user']['rol_nombre_ct'] == 'TUTOR') : ?>
  <p>BIENVENIDO TUTOR</p>
<?php endif ?>



<?php if ($_SESSION['user']['rol_nombre_ct'] == 'ALUMNO') : ?>
  <p>BIENVENIDO ALUMNO</p>
<?php endif ?>