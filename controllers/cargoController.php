<?php

require_once 'models/cargoModel.php';

class cargoController {

    public $edit = false;

    public function index() { 
        $object = new cargoModel();
        $items = $object->get_cargos();

        require_once 'views/cargo/lista.php';
    }

    public function registro() {
        Utils::isAdmin();
        require_once 'views/cargo/form.php';
    }

    public function editar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $object = new cargoModel();
            $object->setIdCargo($id);
            $cargo = pg_fetch_object($object->get_cargo_id());

            require_once 'views/cargo/form.php';
        }
    }

    public function guardar() {
        Utils::isAdmin();
        if (isset($_POST)) {
            $object = new cargoModel();
            $object->setNombreCargo($_POST['nombre_cargo']);
            $object->setSalarioBase(strpos($_POST['salario_base'], ",")? str_replace(",",".",$_POST['salario_base']): $_POST['salario_base'].".00");

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $object->setIdCargo($id);
                $save = $object->editar();
            } else {
                $save = $object->guardar();
            }

            if ($save) {
                $_SESSION['cargo'] = isset($_GET['id'])? ((object) array('valor'=> 'Cargo Editado con Exito!', 'clase'=> 'alert-success')): ((object) array('valor'=> 'Cargo Guardado con Exito!', 'clase'=> 'alert-success'));
            } else {
                $_SESSION['cargo'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
            
            header("Location: ".base_url."cargo/index");
        }
    }


}