<div class="row">
    <div class="col-md-6">
        <h4>Mi Perfil</h4>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=base_url."usuario/guardarPerfil&id=".$usuario->id_usuario?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" disabled name="nombre" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->nombre) : ''; ?>" placeholder="Ingresar Nombre"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="apellido">Apellido</label>
                    <input type="text" class="form-control form-control-sm" disabled name="apellido" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->apellido) : ''; ?>"placeholder="Ingresar Apellido"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="cedula">Cedula</label>
                    <input type="text" class="form-control form-control-sm" disabled name="cedula" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->cedula) : ''; ?>"placeholder="Ingresar Cedula"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="correo">Correo</label>
                    <input type="text" class="form-control form-control-sm" disabled name="correo" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->correo_electronico) : ''; ?>"placeholder="Ingresar Correo Electronico"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="telefono">Telefono</label>
                    <input type="text" class="form-control form-control-sm" name="telefono" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->telefono) : ''; ?>"placeholder="Ingresar Telefono de Contacto"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="direccion">Direccion</label>
                    <input type="text" class="form-control form-control-sm" name="direccion" value="<?=isset($usuario) && is_object($usuario) ? trim($usuario->direccion) : ''; ?>"placeholder="Ingresar Direccion de Vivienda"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="clave">Clave de Acceso</label>
                    <input type="text" class="form-control form-control-sm" name="clave" value="" placeholder="Ingresar nueva clave de acceso sí desea cambiarla"/>
                </div>
                <div class="form-group col-sm-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>