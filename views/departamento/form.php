<div class="row">
    <div class="col-md-6">
        <?php if(isset($edit) && isset($departamento) && is_object($departamento)): ?>
            <h4>Editar departamento</h4>
            <?php $url_action = base_url."departamento/guardar&id=".$departamento->id_departamento; ?>
        <?php else: ?>
            <h4>Agregar departamento</h4>
            <?php $url_action = base_url."departamento/guardar"; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>departamento/index" class="btn btn-warning btn-sm">VOLVER</a>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=$url_action?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="nombre_departamento">Nombre del departamento</label>
                    <input type="text" class="form-control form-control-sm" name="nombre_departamento" required value="<?=isset($departamento) && is_object($departamento) ? $departamento->nombre_departamento : ''; ?>" placeholder="Ingresar Nombre Departamento"/>
                </div>
                <div class="form-group col-sm-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>

