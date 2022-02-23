<nav id="sidebar">
    <div class="sidebar-header">
        <img src="<?=base_url?>assets/img/logo-paysys.png" alt="Paysys" width='100%'>
        <strong>PS</strong>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="<?=base_url?>inicio/index">
                <i class="fas fa-home"></i> Inicio
            </a>
        </li>
        <?php if(isset($_SESSION['identity']) && isset($_SESSION['admin'])){ ?>

            <li>
                <a href="<?=base_url?>departamento/index">
                    <i class="fas fa-building"></i> Departamentos
                </a>
            </li>
            <li>
                <a href="<?=base_url?>cargo/index">
                    <i class="fas fa-people-carry"></i> Cargos
                </a>
            </li>
            <li>
                <a href="<?=base_url?>nomina/index">
                    <i class="fas fa-hand-holding-usd"></i> Nominas
                </a>
            </li>
            <li>
                <a href="<?=base_url?>usuario/index">
                    <i class="fas fa-money-check-alt"></i> Usuarios
                </a>
            </li>
            <li>
                <a href="<?=base_url?>detallePago/index">
                    <i class="fas fa-money-check-alt"></i> Detalles Pago
                </a>
            </li>

        <?php } if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
        ?>

            <li>
                <a href="<?=base_url?>trabajador/index">
                    <i class="fas fa-briefcase"></i> Trabajadores
                </a>
            </li>
            <li>
                <a href="<?=base_url?>cargo/index">
                    <i class="fas fa-people-carry"></i> Cargos
                </a>
            </li>
            <li>
                <a href="<?=base_url?>nomina/index">
                    <i class="fas fa-hand-holding-usd"></i> Nominas
                </a>
            </li>
            <li>
                <a href="<?=base_url?>detallePago/index">
                    <i class="fas fa-money-check-alt"></i> Detalles Pago
                </a>
            </li>

        <?php } ?>
        
    </ul>
</nav>