<style>
.div-login {
    width: 25vw;
    position: absolute;
    top: 50%;
    left: 20%;
    margin-top: -130px;
    padding: 30px;
    background: #dc354563;
    border-radius: 10px;
    border-left: 3px solid #ffcc00;
}

.div-content {
    background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,1)), url(assets/img/bg-login.jpg);
}
</style>

<div class="div-login">
    <form action="<?=base_url?>usuario/login" method="post">
        <div class="form-group">
            <label class="font-weight-bold mb-0" for="usuario">Correo Electrónico</label>
            <input type="email" class="form-control form-control-sm" name="usuario" placeholder="Introducir Correo Electrónico" required>
        </div>
        <div class="form-group">
            <label class="font-weight-bold mb-0" for="clave">Contraseña</label>
            <input type="password" class="form-control form-control-sm" name="clave" required>
        </div>
        <button type="submit" class="btn btn-primary btn-sm btn-block">Iniciar Sesión</button>
    </form>
</div>
