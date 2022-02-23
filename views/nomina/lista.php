<div id="reporte">
    <div class="row">
        <div class="col-md-6">
            <h4>NOMINA</h4>
        </div>
        <div class="col-md-6"></div>


        <div class="col-sm-12">
            <div class="row d-flex justify-content-around">
                <div class="col-md-8">
                    <?php if(isset($_SESSION['nomina'])): ?>
                        <div class="alert <?=$_SESSION['nomina']->clase?> alert-dismissible fade show mt-3 mb-3 pt-1 pb-1" role="alert">
                            <?=$_SESSION['nomina']->valor?>
                            <button type="button" class="close pt-1 pb-1" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php Utils::deleteSession('nomina'); ?>
                </div>
                <div class="col-sm-8">
                    <form action="<?= base_url."nomina/search" ?>" method="post">
                        <div class="row">
                            <div class="col-sm-8 input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Cédula:</div>
                                </div>
                                <input type="text" class="form-control" id="filter" name="filter" placeholder="Introducir la cédula del trabajador">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
                        
            </div>
        
        
        </div>
        

        <div class="col-md-12 mt-3">
            <table class="table table-secondary table-hover table-sm ">
                <thead class="bg-danger text-center text-white">
                    <tr>
                        <th>Tipo de pago</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($body) {
                        $montoTotal = 0;

                    while ($item = pg_fetch_array($body)) {
                        if (trim($item['tipo_pago']) == 'A') {
                            $montoTotal = $montoTotal + $item['monto'];
                        } else {
                            $montoTotal = $montoTotal - $item['monto'];
                        }

                ?>
                    <tr>
                        <td><?php echo $item['tipo_pago'];?></td>
                        <td><?php echo $item['descripcion'];?></td>
                        <td><?php echo $item['fecha'];?></td>
                        <td><?php echo $item['monto'];?></td>
                    </tr>
                <?php 
                    }
                    echo $montoTotal;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
