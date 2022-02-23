<?php

require_once 'models/nominaModel.php';

class nominaController {

    public $montoTotal;

    public function index() {
        Utils::isIdentity();

        $body = false;


        require_once 'views/nomina/lista.php';
    }

    public function search() {
        if (isset($_POST)) {
            $cedula = isset($_POST['filter'])? $_POST['filter']: false;

            if ($cedula) {
                $object = new nominaModel();
                $object->setCedula($cedula);
                $header = pg_fetch_object($object->buscar_trabajador());
                if ($header) {
                    $object->setTrabajador_id($header->id_trabajador);
                    // var_dump($header);

                    $body = $object->buscar_body_nomina();
                    // var_dump($body);



                    require_once 'views/nomina/lista.php';
                } else {
                    var_dump('ese cedula no existe!!');
                }

            } else {
                $_SESSION['nomina'] = (object) array('valor'=> 'Consulta fallida, introduce bien la cédula', 'clase'=> 'alert-danger');
                header('Location:'.base_url.'nomina/index');
            }

        }
    }

}

?>
