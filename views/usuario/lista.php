<div class="row">
    <div class="col-md-6">
        <h4>USUARIOS</h4>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>usuario/registro" class="btn btn-warning btn-sm">REGISTRAR USUARIO</a>
    </div>
    <div class="col-md-12">
        <?php if(isset($_SESSION['usuario'])): ?>
            <div class="alert <?=$_SESSION['usuario']->clase?> alert-dismissible fade show mt-3 mb-0" role="alert">
                <?=$_SESSION['usuario']->valor?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('usuario'); ?>
    </div>
    <div class="col-md-12 mt-3">
        <table class="table table-secondary table-hover">
            <thead class="bg-danger text-center text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
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
                    <td><?php echo $item['cedula'];?></td>
                    <td><?php echo $item['telefono'];?></td>
                    <td><?php echo $item['correo_electronico'];?></td>
                    <td><?php echo $item['direccion'];?></td>
                    <td>
                        <a href="<?=base_url?>usuario/editar&id=<?=$item['id_usuario']?>" class="btn btn-success btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?=base_url?>usuario/eliminar&id=<?=$item['id_usuario']?>" class="btn btn-danger btn-sm" title="Eliminar">
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