<h1 class="text-center">Registro de Usuarios</h1>
<div class="row justify-content-center">
    <form class="col-lg-4 border rounded shadow p-3">
        <div class="row mb-3">
            <div class="col">
                <label for="usu_nombre">Nombre de Usuario</label>
                <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" autocomplete="username">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="usu_catalogo">Catalogo</label>
                <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="usu_password">Establezca una Contraseña</label>
                <input type="password" name="usu_password" id="usu_password" class="form-control" autocomplete="new-password">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="usu_password2">Confirme su Contraseña</label>
                <input type="password" name="usu_password2" id="usu_password2" class="form-control" autocomplete="new-password">
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-success W-100">Registrar</button>
        </div>
    </form>
</div>

<script src="<?= asset('./build/js/auth/registro.js') ?>"></script>
