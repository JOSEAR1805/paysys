<?php

require_once 'models/usuarioModel.php';

class usuarioController {

    public $edit = false;

    public function index() {
        Utils::isIdentity();
        $object = new usuarioModel();
        $items = $object->get_usuarios();
        require_once 'views/usuario/lista.php';
    }

    public function perfil() {
        if(isset($_SESSION['identity'])){
            $edit = true;

            $object = new usuarioModel();
            $object->setId_usuario($_SESSION['identity']->id_usuario);
            $usuario = pg_fetch_object($object->get_usuario_id());

            require_once 'views/usuario/perfil.php';
        }
    }

    public function registro() {
        Utils::isAdmin();
        require_once 'views/usuario/form.php';
    }

    public function guardar() {
        Utils::isAdmin();
        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            if ($nombre && $apellido && $cedula && $correo) { 
                 $object = new usuarioModel();

                    $object->setNombre($nombre);
                    $object->setApellido($apellido);
                    $object->setCedula($cedula);
                    $object->setTelefono($telefono);
                    $object->setCorreo($correo);
                    $object->setDireccion($direccion);

                if(isset($_GET['id'])){
                    $object->setId_usuario($_GET['id']);
                    $save = $object->editar();
                }else{
                    $save = $object->guardar();
                }

                if ($save) {
                    $_SESSION['usuario'] = isset($_GET['id'])? ((object) array('valor'=> 'Usuario editado con exito!', 'clase'=> 'alert-success')): ((object) array('valor'=> 'Usuario guardado con exito!', 'clase'=> 'alert-success'));
                } else {
                    $_SESSION['usuario'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
                }
                header('Location:'.base_url.'usuario/index');
            }
        } 
    }

    public function guardarPerfil() {
        if(isset($_POST)) {
            $object = new usuarioModel();
            $object->setId_usuario($_SESSION['identity']->id_usuario);
            $object->setPersona_id($_SESSION['identity']->persona_id);
            $object->setTelefono($_POST['telefono']);
            $object->setDireccion($_POST['direccion']);
            $object->setClave($_POST['clave']);
            
            $save = $object->editarPerfil();

            if ($save) {
                $_SESSION['usuario'] = (object) array('valor'=> 'Usuario editado con exito!', 'clase'=> 'alert-success');
            } else {
                $_SESSION['usuario'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
            header('Location:'.base_url.'inicio/index');
        }
    }

    public function editar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $edit = true;

            $object = new usuarioModel();
            $object->setId_usuario($_GET['id']);
            $usuario = pg_fetch_object($object->get_usuario_id());

            require_once 'views/usuario/form.php';
        }
    }

    public function eliminar() {
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $object = new usuarioModel();
            $object->setId_usuario($id);
            
            $result = $object->eliminar();
           ;
            if ($result) {
                $_SESSION['usuario'] = (object) array('valor'=> 'Usuario eliminado con exito!', 'clase'=> 'alert-info');
            } else {
                $_SESSION['usuario'] = (object) array('valor'=> 'Operación Fallida!', 'clase'=> 'alert-danger');
            }
            header('Location:'.base_url.'usuario/index');
        }
    }


    public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$object = new usuarioModel();
            var_dump($object);
			$object->setCorreo($_POST['usuario']);
			$object->setClave($_POST['clave']);
			
            $identity = $object->login();
            

			
			if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
				
				if(trim($identity->nombre_rol) == 'admin'){
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
    }
    
    public function logout(){
        if(isset($_SESSION['admin'])){
            Utils::deleteSession('admin');
        }
        
        if(isset($_SESSION['identity'])){
            Utils::deleteSession('identity');
        }
		
        session_destroy();
		header("Location:".base_url);
	}
}