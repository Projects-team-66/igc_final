<div class="row justify-content-center mb-5">
    <i class="bi bi-door-open icon-large"></i>
    <h1 class="text-center">Inicio de Sesión</h1>
</div>
<div class="row justify-content-center">
    <form class="col-lg-4 border rounded shadow p-3">
        <div class="row mb-3">
            <div class="col">
                <label for="usu_catalogo">Catalogo</label>
                <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="usu_password">Contraseña</label>
                <input type="password" name="usu_password" id="usu_password" class="form-control" autocomplete="new-password">
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-success W-100">Iniciar Sesion <i class="bi bi-box-arrow-up-right"></i></button>
        </div>
    </form>
</div>

<script src="<?= asset('./build/js/auth/login.js') ?>"></script>