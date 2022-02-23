<?php

require_once 'models/usuarioModel.php';

class inicioController {

    public function index() {
        if(isset($_SESSION['identity'])) {
            require_once 'views/inicio/inicio.php';
        } else {
            require_once 'views/inicio/login.php';
        }
    }

}