<div class="row">
    <div class="col-md-6">
        <h4>TRABAJADORES</h4>
    </div>
    <div class="col-md-6 text-right">
        <?php if(trim($_SESSION['identity']->nombre_rol) == 'user') { ?>
            <a href="<?=base_url?>trabajador/registro" class="btn btn-warning btn-sm">REGISTRAR TRABAJADOR</a>
        <?php } ?>
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
        <table class="table table-secondary table-hover table-sm ">
                <thead class="bg-danger text-center text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Departamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($items) {

                while ($item = pg_fetch_array($items)) {
            ?>
                <tr>
                    <td><?php echo $item['nombre'];?></td>
                    <td><?php echo $item['apellido'];?></td>
                    <td><?php echo 'V - '.$item['cedula'];?></td>
                    <td><?php echo $item['telefono'];?></td>
                    <td><?php echo $item['nombre_cargo'];?></td>
                    <td><?php echo $item['nombre_departamento'];?></td>
                    <td>
                        <a href="<?=base_url?>trabajador/editar&id=<?=$item['id_trabajador']?>" class="btn btn-success btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?=base_url?>trabajador/eliminar&id=<?=$item['id_trabajador']?>" class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fas fa-user-times"></i>
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