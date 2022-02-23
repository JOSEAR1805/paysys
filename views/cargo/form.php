<div class="row">
    <div class="col-md-6">
        <?php if(isset($edit) && isset($cargo) && is_object($cargo)): ?>
            <h4>Editar Cargo</h4>
            <?php $url_action = base_url."cargo/guardar&id=".$cargo->id_cargo; ?>
        <?php else: ?>
            <h4>Agregar Cargo</h4>
            <?php $url_action = base_url."cargo/guardar"; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>cargo/index" class="btn btn-warning btn-sm">VOLVER</a>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=$url_action?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="nombre_cargo">Nombre del Cargo</label>
                    <input type="text" class="form-control form-control-sm" name="nombre_cargo" value="<?=isset($cargo) && is_object($cargo) ? trim($cargo->nombre_cargo) : ''; ?>" placeholder="Ingresar Nombre"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="salario_base">Salario Base</label>
                    <input type="text" class="form-control form-control-sm" name="salario_base" value="<?=isset($cargo) && is_object($cargo)? str_replace(".",",",trim($cargo->salario_base)): ''; ?>"placeholder="Ingresar Monto"/>
                </div>
                <div class="form-group col-sm-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>