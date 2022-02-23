<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Paysys</title>

    <link rel="stylesheet" href="<?=base_url?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php if(isset($_SESSION['identity'])){require_once 'sidebar.php';}?>
        <!-- Page Content Holder -->
        <div id="content" class="container-fluid">

            <div class="row div-header">
                <div class="col-md-8 p-0">
                    <img src="<?=base_url?>assets/img/cabecera.png" alt="" style="margin: 4px 0px;">
                </div>
                <div class="col-md-4 p-0">
                    <img src="<?=base_url?>assets/img/logo-cantv.png" alt="" style="float: right; width: 20%; margin: 6px;">
                </div>
                
                <?php if ( isset($_SESSION['identity']) ) { ?>
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">

                                <button type="button" id="sidebarCollapse" class="btn btn-ligh btn-sm">
                                    <i class="fas fa-align-left"></i>
                                </button>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-ligh btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?=$_SESSION['identity']->nombre_usuario?> <i class="fa fa-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?=base_url?>usuario/perfil" type="button">Perfil</a>
                                        <a class="dropdown-item" href="<?=base_url?>usuario/logout" type="button">Cerrar Sesión</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                <?php } ?>
            </div>

            <div class="row div-content">
                <div class="container">