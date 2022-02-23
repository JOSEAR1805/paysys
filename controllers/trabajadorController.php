<?php

require_once 'models/trabajadorModel.php';

class trabajadorController {

    public $edit = false;

    public function index() {
        Utils::isIdentity();
        $object = new trabajadorModel();
        $items = $object->get_trabajadores();

        require_once 'views/trabajador/lista.php';
    }

    public function registro() {
        Utils::isUser();
        $object = new trabajadorModel();
        $cargos = $object->get_cargos();
        $departamentos = $object->get_departamentos();
        require_once 'views/trabajador/form.php';
    }

    public function editar() {
        Utils::isUser();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $object = new trabajadorModel();
            $cargos = $object->get_cargos();
            $departamentos = $object->get_departamentos();
            $trabajador = pg_fetch_object($object->get_trabajador_id($id));

            require_once 'views/trabajador/form.php';
        }
    }

    public function guardar() {
        Utils::isUser();
        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $departamento_id = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $cargo_id = isset($_POST['cargo']) ? $_POST['cargo'] : false;

            $trabajador = (object) array(
                'nombre' =>  $_POST['nombre'],
                'apellido' =>  $_POST['apellido'],
                'cedula' =>  $_POST['cedula'],
                'telefono' =>  $_POST['telefono'],
                'correo_electronico' =>  $_POST['correo'],
                'direccion' =>  $_POST['direccion'],
                'nombre_departamento' =>  $_POST['departamento'],
                'nombre_cargo' =>  $_POST['cargo'],
            );

            if ($nombre && $apellido && $cedula && $correo && $departamento_id && $cargo_id) { 
                $object = new trabajadorModel();
                
                $object->setNombre($nombre);
                $object->setApellido($apellido);
                $object->setCedula($cedula);
                $object->setTelefono($telefono);
                $object->setCorreo($correo);
                $object->setDireccion($direccion);
                $object->setDepartamento_id($departamento_id);
                $object->setCargo_id($cargo_id);
    
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $object->setId_trabajador($id);
                    
                    $resultado = $object->editar();
                }else{
                    $resultado = $object->guardar();
                }

                // var_dump($resultado? true: false);

                if ($resultado) {
                    $_SESSION['trabajador'] = isset($_GET['id'])? ((object) array('valor'=> 'Usuario editado con exito!', 'clase'=> 'alert-success')): ((object) array('valor'=> 'Usuario guardado con exito!', 'clase'=> 'alert-success'));
                    header('Location:'.base_url.'trabajador/index');
                } else {
                    $_SESSION['trabajador'] = ((object) array('valor'=> $resultado == 0? 'La cedula o el correo electrónico ingresado ya se encuentra en uso en el sistema!': 'Operación Fallida!', 'clase'=> 'alert-danger'));
                    header('Location:'.base_url.'trabajador/registro');
                }
            } else {
                $_SESSION['trabajador'] = (object) array('valor'=> 'Registro fallido, introduce bien los datos', 'clase'=> 'alert-danger');
                header('Location:'.base_url.'trabajador/registro');
            }
        }
    }

    public function eliminar() {
        Utils::isUser();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $object = new trabajadorModel();
            $object->setId_trabajador($id);
            
            $resulto = $object->eliminar();

            if ($resulto) {
                $_SESSION['trabajador'] = (object) array('valor'=> 'Usuario eliminado con exito!', 'clase'=> 'alert-info');
            } else {
                $_SESSION['trabajador'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
        }
        header('Location:'.base_url.'trabajador/index');
    }

    

}