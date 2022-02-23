<?php

 require_once 'models/detallePagoModel.php';
 require_once 'models/trabajadorModel.php';

class detallePagoController {

    public function index() {
        $object = new detallePagoModel();
        $items = $object->get_detalles();

        require_once 'views/detalle_pago/lista.php';
    }


    public function registro() {
        Utils::isAdmin();
        $object = new trabajadorModel();
        $trabajadores = $object->get_trabajadores();

        require_once 'views/detalle_pago/form.php';
    }

    
    public function editar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;
            
            $object = new detallePagoModel();
            $detalle = pg_fetch_object($object->get_detalles_id($id));
            $object = new trabajadorModel();
            $trabajadores = $object->get_trabajadores();

            require_once 'views/detalle_pago/form.php';
        }
    }

    public function guardar() {
        Utils::isAdmin();

        if(isset($_POST)) {
            $object = new detallePagoModel();
            $object->setTipo_pago($_POST['tipo_pago']);
            $object->setDescripcion($_POST['descripcion']);
            $object->setFecha($_POST['fecha']);
            $object->setMonto( str_replace ('.', '', str_replace(',00', '', str_replace('Bs. ', '', $_POST['monto']))) );
            $object->setDirigido($_POST['dirigido']);

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $object->setId_detalle($id);
                
                $save = $object->editar();
            } else {
                $save = $object->guardar();
            }

            if ($save) {
                $_SESSION['detalle'] = isset($_GET['id'])? ((object) array('valor'=> 'Detalle Editado con Exito!', 'clase'=> 'alert-success')): ((object) array('valor'=> 'Detalle Guardado con Exito!', 'clase'=> 'alert-success'));
            } else {
                $_SESSION['detalle'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
            header('Location:'.base_url.'detallePago/index');
        }
    }

    public function eliminar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $object = new detallePagoModel();
            $object->setId_detalle($id);
            
            $result = $object->eliminar();

            if ($result) {
                $_SESSION['detalle'] = (object) array('valor'=> 'Detalle Eliminado con Exito!', 'clase'=> 'alert-info');
            } else {
                $_SESSION['detalle'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
        }
        header('Location:'.base_url.'detallePago/index');
   
    }


}   