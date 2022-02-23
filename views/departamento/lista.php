<div class="row">
    <div class="col-md-6">
        <h4>DEPARTAMENTOS</h4>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?=base_url?>departamento/registro" class="btn btn-warning btn-sm">REGISTRAR DEPARTAMENTO</a>
    </div>
        
    <div class="col-md-12">
        <?php if(isset($_SESSION['departamento'])): ?>
            <div class="alert <?=$_SESSION['departamento']->clase?> alert-dismissible fade show mt-3 mb-0" role="alert">
                <?=$_SESSION['departamento']->valor?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('departamento'); ?>
    </div>
        

    <div class="col-md-12 mt-3">
    <table class="table table-secondary table-hover table-sm ">
            <thead class="bg-danger text-center text-white">
                <tr>
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
                    <td><?php echo $item['nombre_departamento'];?></td>
                     <td class="text-right">
                        <a href="<?=base_url?>departamento/editar&id=<?=$item['id_departamento']?>" class="btn btn-success btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
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
