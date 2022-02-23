<div class="row">
    <div class="col-md-6">
        <?php if(isset($edit) && isset($detalle) && is_object($detalle)): ?>
            <h4>Editar detalle de pago</h4>
            <?php $url_action = base_url."detallePago/guardar&id=".$detalle->id_detalle; ?>
        <?php else: ?>
            <h4>Agregar Detalle de pago</h4>
            <?php $url_action = base_url."detallePago/guardar"; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>detallePago/index" class="btn btn-warning btn-sm">VOLVER</a>
    </div>
    
    <div class="col-md-12 mt-3">
        <form action="<?=$url_action?>" method="post">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="tipo_pago">Tipo de Pago</label>
                    <select name="tipo_pago" class="form-control form-control-sm"required >
                        <option value="<?=isset($detalle) && is_object($detalle)? $detalle->tipo_pago: '';?>">
                            <?= isset($detalle) && is_object($detalle)? (trim($detalle->tipo_pago) == 'A'? 'Asignación': (trim($detalle->tipo_pago) == 'D'? 'Deducción': 'Seleccionar')): 'Seleccionar'; ?>
                        </option>
                        <?php if (isset($detalle) && is_object($detalle)) { ?>
                            <option value="<?=trim($detalle->tipo_pago) == 'A'? 'D': 'A';?>"required >
                                <?=trim($detalle->tipo_pago) == 'A'? 'Deducción': 'Asignación';?>
                            </option>
                        <?php } else { ?>
                            <option value="A">Asignación</option>
                            <option value="D">Deducción</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="descripcion">Descripción</label>
                    <input type="text" class="form-control form-control-sm" name="descripcion" value="<?=isset($detalle) && is_object($detalle) ? trim($detalle->descripcion) : ''; ?>"  required  placeholder="Ingresar Descripcion de Pago"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="fecha">Fecha</label>
                    <input type="date" class="form-control form-control-sm" name="fecha" value="<?=isset($detalle) && is_object($detalle) ? trim($detalle->fecha) : ''; ?>"required />
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="monto">Monto</label>
                    <input type="text" class="form-control form-control-sm" name="monto" value="<?=isset($detalle) && is_object($detalle) ? trim($detalle->monto) : ''; ?>"required placeholder="Ingresar Monto"/>
                </div>
                <div class="form-group col-sm-6">
                    <label class="font-weight-bold mb-0" for="dirigido">Dirigido</label>
                    <select name="dirigido" id="" class="form-control form-control-sm" >
                        <option value="<?=isset($detalle) && is_object($detalle) && !is_null($detalle->trabajador_id)? $detalle->trabajador_id: '';?>">
                            <?=isset($detalle) && is_object($detalle) && !is_null($detalle->trabajador_id) && $detalle->trabajador_id != 0? ($detalle->nombre.' '.$detalle->apellido): 'Todos los Trabajadores'; ?> 
                        </option>
                        
                        <?php if(isset($detalle) && is_object($detalle) && !is_null($detalle->trabajador_id) && $detalle->trabajador_id != 0) { ?>
                            <option value="">Todos los Trabajadores </option>
                        <?php } ?>

                        <?php 
                            while ($trabajador = pg_fetch_array($trabajadores)) { 
                                if ( $detalle->trabajador_id != $trabajador['id_trabajador'] ) {
                        ?>
                            <option value="<?=$trabajador['id_trabajador']?>">
                                <?=$trabajador['nombre'].''.$trabajador['apellido']?>
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