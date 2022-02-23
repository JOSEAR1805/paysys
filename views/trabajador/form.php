<div class="row">
    <div class="col-md-6">
        <?php if(isset($edit) && isset($trabajador) && is_object($trabajador)): ?>
            <h4>Editar Trabajador <?=$trabajador->nombre?></h4>
            <?php $url_action = base_url."trabajador/guardar&id=".$trabajador->id_trabajador; ?>
        <?php else: ?>
            <h4>Agregar Trabajador</h4>
            <?php $url_action = base_url."trabajador/guardar"; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>trabajador/index" class="btn btn-warning btn-sm">VOLVER</a>
    </div>

    <div class="col-md-12">
        <?php if(isset($_SESSION['trabajador'])): ?>
            <div class="alert <?=$_SESSION['trabajador']->clase?> alert-dismissible fade show mt-3 mb-0" role="alert">
                <?=$_SESSION['trabajador']->valor?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('trabajador'); ?>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=$url_action?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="nombre">Nombre </label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="<?=isset($trabajador) && is_object($trabajador) ? trim($trabajador->nombre) : ''; ?>" pattern="[A-Za-z]{3,50}" required placeholder="Ingresar Nombre" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="apellido">Apellido </label>
                    <input type="text" class="form-control form-control-sm" name="apellido" value="<?=isset($trabajador) && is_object($trabajador) ?trim($trabajador->apellido)  : ''; ?>" required placeholder="Ingresar Apellido" autofocus />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="cedula">Cedula </label>
                    <input type="number" class="form-control form-control-sm" name="cedula" value="<?=isset($trabajador) && is_object($trabajador) ? trim($trabajador->cedula) : ''; ?>" required placeholder="Ingresar Cedula" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="telefono">Telefono</label>
                    <input type="number" class="form-control form-control-sm" name="telefono" value="<?=isset($trabajador) && is_object($trabajador) ? trim($trabajador->telefono) : ''; ?>"placeholder="Ingresar Telefono de Contacto"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="correo">Correo </label>
                    <input type="email" class="form-control form-control-sm" name="correo" value="<?=isset($trabajador) && is_object($trabajador) ? trim($trabajador->correo_electronico) : ''; ?>" required placeholder="Ingresar Correo Electronico" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="direccion">Direccion</label>
                    <input type="text" class="form-control form-control-sm" name="direccion" value="<?=isset($trabajador) && is_object($trabajador) ? trim($trabajador->direccion) : ''; ?>"placeholder="Ingresar Direccion de Vivienda" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="departamento">Departamento<span class="text-danger">*</span> </label>
                    <select name="departamento" id="" class="form-control form-control-sm" required >
                        <option value="<?=isset($trabajador) && is_object($trabajador) ? $trabajador->id_departamento : '';?>"> <?= isset($trabajador) && is_object($trabajador) ? $trabajador->nombre_departamento : 'Seleccionar'; ?></option>
                        <?php 
                            while ($departamento = pg_fetch_array($departamentos)) { 
                                if ( $trabajador->id_departamento != $departamento['id_departamento'] ) {
                        ?>
                                    <option value="<?=$departamento['id_departamento']?>">
                                        <?=$departamento['nombre_departamento']?>
                                    </option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="cargo">Cargo<span class="text-danger">*</span> </label>
                    <select name="cargo" id="" class="form-control form-control-sm" required >
                        <option value="<?=isset($trabajador) && is_object($trabajador) ? $trabajador->id_cargo : '';?>"> <?= isset($trabajador) && is_object($trabajador) ? $trabajador->nombre_cargo : 'Seleccionar'; ?> </option>
                        <?php 
                            while ($cargo = pg_fetch_array($cargos)) { 
                                if ( $trabajador->id_cargo != $cargo['id_cargo'] ) {
                        ?>
                            <option value="<?=$cargo['id_cargo']?>">
                                <?=$cargo['nombre_cargo']?>
                            </option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>
