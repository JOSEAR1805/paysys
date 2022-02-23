<?php

 require_once 'models/departamentoModel.php';

class departamentoController {

    public function index() {
         $object = new departamentoModel();
         $items = $object->get_departamentos();

        require_once 'views/departamento/lista.php';
    }

    public function registro() {
        Utils::isAdmin();
        require_once 'views/departamento/form.php';
    }

    public function editar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $object = new departamentoModel();
            $object->setIdDepartamento($id);
            $departamento = pg_fetch_object($object->get_departamento_id());

            require_once 'views/departamento/form.php';
        }
    }

    public function guardar() {
        Utils::isAdmin();
        if(isset($_POST)) {
            $object = new departamentoModel();
            $object->setNombreDepartamento($_POST['nombre_departamento']);

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $object->setIdDepartamento($id);
                
                $save = $object->editar();
            }else{
                $save = $object->guardar();
            }

            if ($save) {
                $_SESSION['departamento'] = isset($_GET['id'])? ((object) array('valor'=> 'Departamento Editado con Exito!', 'clase'=> 'alert-success')): ((object) array('valor'=> 'Departamento Guardado con Exito!', 'clase'=> 'alert-success'));
            } else {
                $_SESSION['departamento'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
            header('Location:'.base_url.'departamento/index');
        }
    }
}

