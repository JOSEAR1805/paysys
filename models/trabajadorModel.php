<?php

class trabajadorModel{

    private $id_trabajador;
    private $nombre;
    private $apellido;
    private $cedula;
    private $telefono;
    private $correo;
    private $direccion;
    private $persona_id;
    private $departamento_id;
    private $cargo_id;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
    }

    function getId_trabajador() { 
        return $this->id_trabajador; 
    }

    function getNombre() { 
        return $this->nombre; 
    }

    function getApellido() { 
        return $this->apellido; 
    }

    function getCedula() { 
        return $this->cedula; 
    }

    function getTelefono() { 
        return $this->telefono; 
    }

    function getCorreo() { 
        return $this->correo; 
    }

    function getDireccion() { 
        return $this->direccion; 
    }

    function getPersona_id() {
        return $this->persona_id;
    }

    function getDepartamento_id() { 
        return $this->departamento_id; 
    }

    function getCargo_id() { 
        return $this->cargo_id; 
    }

//SET

    function setId_trabajador($id) { 
        $this->id_trabajador = $id; 
    }

    function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }

    function setApellido($apellido) { 
        $this->apellido = $apellido; 
    }

    function setCedula($cedula) { 
        $this->cedula = $cedula; 
    }

    function setTelefono($telefono) { 
        $this->telefono = $telefono;
    }

    function setCorreo($correo) { 
        $this->correo = $correo; 
    }

    function setDireccion($direccion) { 
        $this->direccion = $direccion; 
    }

    function setPersona_id($id) {
        $this->persona_id = $id;
    }

    function setDepartamento_id($departamento_id) { 
        $this->departamento_id = $departamento_id; 
    }
    
    function setCargo_id($cargo_id) { 
        $this->cargo_id = $cargo_id; 
    }

    public function get_trabajadores() {
        $query = "SELECT  * FROM tb_trabajadores
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_trabajadores.persona_id
        LEFT JOIN tb_departamentos ON tb_departamentos.id_departamento = tb_trabajadores.departamento_id
        LEFT JOIN tb_cargos ON tb_cargos.id_cargo = tb_trabajadores.cargo_id 
        WHERE tb_trabajadores.estado_trabajador = TRUE";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_trabajador_id($id) {
        $query = "SELECT  * FROM tb_trabajadores
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_trabajadores.persona_id
        LEFT JOIN tb_departamentos ON tb_departamentos.id_departamento = tb_trabajadores.departamento_id
        LEFT JOIN tb_cargos ON tb_cargos.id_cargo = tb_trabajadores.cargo_id
        WHERE tb_trabajadores.id_trabajador = $id";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_cargos() {
        $query = "SELECT * FROM tb_cargos;";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_departamentos() {
        $query = "SELECT * FROM tb_departamentos;";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function guardar() {
        $query = "SELECT id_persona FROM tb_personas WHERE cedula = '{$this->getCedula()}' OR correo_electronico = '{$this->getCorreo()}'";
        $result = pg_query($this->conexion, $query);

        if ($result) {
            return 0;
        } else {
            $query = "INSERT INTO tb_personas (nombre, apellido, cedula, telefono, correo_electronico, direccion)
            VALUES ('{$this->getNombre()}', '{$this->getApellido()}', '{$this->getCedula()}', '{$this->getTelefono()}', '{$this->getCorreo()}', '{$this->getDireccion()}') RETURNING id_persona;";
            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 1: ".pg_last_error());
            if ($result) {
                $id_persona = pg_fetch_array($result);
                $query = "INSERT INTO tb_trabajadores (persona_id, departamento_id, cargo_id)
                VALUES ($id_persona[0], {$this->getDepartamento_id()}, {$this->getCargo_id()})";
    
                $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
                return $result;
            } else {
                return $result;
            }
        }

    }

    public function editar() {
        $query = "UPDATE tb_trabajadores SET departamento_id={$this->getDepartamento_id()}, cargo_id={$this->getCargo_id()} WHERE id_trabajador={$this->getId_trabajador()} RETURNING persona_id";
        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 1: ".pg_last_error());

        if ($result) {
            $this->persona_id = pg_fetch_array($result)["persona_id"];
            $query = "UPDATE tb_personas SET nombre='{$this->getNombre()}', apellido='{$this->getApellido()}', cedula='{$this->getCedula()}', telefono='{$this->getTelefono()}', correo_electronico='{$this->getCorreo()}', direccion='{$this->getDireccion()}' WHERE id_persona= {$this->persona_id}";

            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
            return $result;
        } else {
            return $result;
        }
    }
    
    public function eliminar() {
        $query = "UPDATE tb_trabajadores SET estado_trabajador = FALSE WHERE id_trabajador={$this->getId_trabajador()}";

        // update tb_personas set cedula = '123456789@', correo_electronico = 'ana@test.com@' where id_persona = 3;

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
        return $result;
    }
}

?>