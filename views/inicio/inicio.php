<div class="row">
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
    <div class="col-sm-12">
        <h1 class="text-center text-info font-weight-bold">
            BIENVENIDO A PAYSYS 
        </h1>
        <h4 class="text-center text-info font-weight-bold">EL SISTEMA DE NOMINA DE CANTV</h4>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-8 mt-3">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?=base_url?>assets/img/carousel-inicio/1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?=base_url?>assets/img/carousel-inicio/2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?=base_url?>assets/img/carousel-inicio/3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?=base_url?>assets/img/carousel-inicio/4.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>