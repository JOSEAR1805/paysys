<div class="row">
    <div class="col-md-6">
        <h4>Detalles de Pagos</h4>
    </div>
    <div class="col-md-6 text-right">
        <?php if(trim($_SESSION['identity']->nombre_rol) == 'admin') { ?>
            <a href="<?=base_url?>detallePago/registro" class="btn btn-warning btn-sm">GENERAR DETALLE</a>
        <?php } ?>
    </div>
        
    <div class="col-md-12">
        <?php if(isset($_SESSION['detalle'])): ?>
            <div class="alert <?=$_SESSION['detalle']->clase?> alert-dismissible fade show mt-3 mb-0" role="alert">
                <?=$_SESSION['detalle']->valor?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('detalle'); ?>
    </div>
        

    <div class="col-md-12 mt-3">
        <table class="table table-secondary table-hover table-sm ">
                <thead class="bg-danger text-center text-white">
                <tr>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Dirigido</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($items) {

                while ($item = pg_fetch_array($items)) {
            ?>
                <tr>
                    <td><?php echo trim($item['tipo_pago']) == 'A'? 'Asignación': 'Deducción';?></td>
                    <td><?php echo $item['descripcion'];?></td>
                    <td><?php echo $item['monto'];?></td>
                    <td><?php echo $item['fecha'];?></td>
                    <td><?php echo $item['trabajador_id'] == 0? 'Todos los Trabajadores': 'V-'.$item['cedula'];?></td>
                    <td>
                        <a href="<?=base_url?>detallePago/editar&id=<?=$item['id_detalle']?>" class="btn btn-success btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?=base_url?>detallePago/eliminar&id=<?=$item['id_detalle']?>" class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php 
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
