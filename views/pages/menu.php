<h1>MENU PRINCIPAL DE LA APP</h1>
<a href="/igc_final/logout" class="btn btn-danger"> SALIR</a>


<?php if($_SESSION['user']['rol_nombre_ct'] == 'INSTITUTO_ADMIN') : ?>
<P>USUARIO ADMINISTRADOR</P>

<?php var_dump($_SESSION)   ?>
<?php endif ?>






