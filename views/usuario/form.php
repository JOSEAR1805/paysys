<div class="row">
    <div class="col-md-6">
        <?php if(isset($edit) && isset($usuario) && is_object($usuario)): ?>
            <h4>Editar usuario <?=$usuario->nombre?></h4>
            <?php $url_action = base_url."usuario/guardar&id=".$usuario->id_usuario; ?>
        <?php else: ?>
            <h4>Agregar usuario</h4>
            <?php $url_action = base_url."usuario/guardar"; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>usuario/index" class="btn btn-warning btn-sm">VOLVER</a>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=$url_action?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->nombre) : ''; ?>"required placeholder="Ingresar Nombre"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="apellido">Apellido</label>
                    <input type="text" class="form-control form-control-sm" name="apellido" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->apellido) : ''; ?>" required placeholder="Ingresar Apellido"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="cedula">Cedula</label>
                    <input type="text" class="form-control form-control-sm" name="cedula" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->cedula) : ''; ?>"required placeholder="Ingresar Cedula"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="telefono">Telefono</label>
                    <input type="text" class="form-control form-control-sm" name="telefono" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->telefono) : ''; ?>"placeholder="Ingresar Telefono de Contacto"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="correo">Correo</label>
                    <input type="text" class="form-control form-control-sm" name="correo" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->correo_electronico) : ''; ?>"required placeholder="Ingresar Correo Electronico"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="direccion">Direccion</label>
                    <input type="text" class="form-control form-control-sm" name="direccion" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->direccion) : ''; ?>"placeholder="Ingresar Direccion de Vivienda"/>
                </div>
                <div class="form-group col-sm-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>