<?php

class usuarioModel{

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $cedula;
    private $telefono;
    private $correo;
    private $direccion;
    private $clave_usuario;
    private $persona_id;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
    }

    // GET
    function getId_usuario() { 
        return $this->id_usuario; 
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

    function getClave() { 
        return $this->clave_usuario; 
    }

    function getPersona_id() { 
        return $this->persona_id; 
    }

    // SET
    function setId_usuario($id) { 
        $this->id_usuario = $id; 
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

    function setClave($clave) { 
        $this->clave_usuario = $clave; 
    }

    function setPersona_id($persona_id) { 
        $this->persona_id = $persona_id; 
    }

    public function get_usuarios() {
        $query = "SELECT * FROM tb_usuarios
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_usuarios.persona_id
        WHERE tb_usuarios.estado_usuario = TRUE";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_usuario_id() {
        $query = "SELECT * FROM tb_usuarios
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_usuarios.persona_id
        WHERE id_usuario={$this->getId_usuario()}";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function guardar() {
        $query = "INSERT INTO tb_personas (nombre, apellido, cedula, telefono, correo_electronico, direccion)
        VALUES ('{$this->getNombre()}', '{$this->getApellido()}', '{$this->getCedula()}', '{$this->getTelefono()}', '{$this->getCorreo()}', '{$this->getDireccion()}')";
        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 1: ".pg_last_error());
        if ($result) {
            $query = "INSERT INTO tb_usuarios (nombre_usuario, clave_usuario, nombre_rol, persona_id)
            VALUES ('{$this->getCorreo()}', '{$this->getCedula()}', 'user', (SELECT MAX(id_persona) FROM tb_personas))";

            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
            return $result;
        } else {
            return $result;
        }
    }

    public function editar() {
        $query = "UPDATE tb_usuarios SET nombre_usuario='{$this->getCorreo()}', clave_usuario='{$this->getCedula()}' WHERE id_usuario={$this->getId_usuario()} RETURNING persona_id";
        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 1: ".pg_last_error());

        if ($result) {
            $this->setPersona_id(pg_fetch_array($result)[0]);
            $query = "UPDATE tb_personas SET nombre='{$this->getNombre()}', apellido='{$this->getApellido()}', cedula='{$this->getCedula()}', telefono='{$this->getTelefono()}', correo_electronico='{$this->getCorreo()}', direccion='{$this->getDireccion()}' WHERE id_persona={$this->getPersona_id()}";

            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
            return $result;
        } else {
            return $result;
        }
    }

    public function editarPerfil() {
        $result = true;
        if ($this->getClave()) {
            $query = "UPDATE tb_usuarios SET clave_usuario='{$this->getClave()}' WHERE id_usuario={$this->getId_usuario()}";
            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 1: ".pg_last_error());
        }

        if ($result) {
            $query = "UPDATE tb_personas SET telefono='{$this->getTelefono()}', direccion='{$this->getDireccion()}' WHERE id_persona={$this->getPersona_id()}";

            $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
            return $result;
        } else {
            return $result;
        }

    }

    public function eliminar() {
        $query = "UPDATE tb_usuarios SET estado_usuario = FALSE WHERE id_usuario={$this->getId_usuario()}";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
        return $result;
    }

    public function login(){
        $query = "SELECT tb_usuarios.*, tb_personas.nombre, tb_personas.apellido FROM tb_usuarios
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_usuarios.persona_id 
        WHERE  nombre_usuario = '{$this->getCorreo()}'";
        $result = pg_query($this->conexion, $query);

		if($result && pg_affected_rows($result) == 1){
            $usuario = pg_fetch_object($result);

            if (trim($this->getClave()) == trim($usuario->clave_usuario)) {
                $result = $usuario;
            } else {
                $result = "false";
            }
		} else {
            $result = "false";
        }
		
		return $result;
	}

}