<div class="row">
    <div class="col-md-6">
        <h4>Cargos</h4>
    </div>
    <div class="col-md-6 text-right">
        <?php if(trim($_SESSION['identity']->nombre_rol) == 'admin') { ?>
            <a href="<?=base_url?>cargo/registro" class="btn btn-warning btn-sm">REGISTRAR CARGO</a>
        <?php } ?>
    </div>
        
    <div class="col-md-12">
        <?php if(isset($_SESSION['cargo'])): ?>
            <div class="alert <?=$_SESSION['cargo']->clase?> alert-dismissible fade show mt-3 mb-0" role="alert">
                <?=$_SESSION['cargo']->valor?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('cargo'); ?>
    </div>
        

    <div class="col-md-12 mt-3">
        <table class="table table-secondary table-hover table-sm">
            <thead class="bg-danger text-white">
                <tr>
                    <th class="text-center" style="width: 50%;">Cargo</th>
                    <th class="text-right" style="width: 30%; padding-right: 15px;">Salario</th>
                    <?php if(trim($_SESSION['identity']->nombre_rol) == 'admin') { ?>
                        <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php if($items) {
                    while($item = pg_fetch_array($items)) {
            ?>
                <tr>
                    <td class="text-center"><?php echo $item['nombre_cargo'];?></td>
                    <td class="text-right" style="padding-right: 15px;"><?php echo str_replace(".",",",$item['salario_base'])." Bs";?></td>
                    <?php if(trim($_SESSION['identity']->nombre_rol) == 'admin') { ?>
                        <td class="text-right">
                            <a href="<?=base_url?>cargo/editar&id=<?=$item['id_cargo']?>" class="btn btn-success btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php 
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>