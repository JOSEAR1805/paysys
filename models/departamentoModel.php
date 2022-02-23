<?php

class departamentoModel {

    private $id_departamento;
    private $nombre_departamento;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
    }

    // GET
    function getIdDepartamento() { 
        return $this->id_departamento; 
    }

    function getNombreDepartamento() { 
        return $this->nombre_departamento; 
    }

    // SET
    function setIdDepartamento($id) { 
        $this->id_departamento = $id; 
    }

    function setNombreDepartamento($nombre ) { 
        $this->nombre_departamento = $nombre; 
    }


    public function get_departamentos() {
        $query = "SELECT * FROM tb_departamentos";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_departamento_id() {
        $query = "SELECT * FROM tb_departamentos WHERE id_departamento = '{$this->getIdDepartamento()}'";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function guardar() {
        $query = "INSERT INTO tb_departamentos (nombre_departamento)
        VALUES ('{$this->getNombreDepartamento()}')";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function editar() {
        $query = "UPDATE tb_departamentos SET nombre_departamento='{$this->getNombreDepartamento()}' WHERE id_departamento='{$this->getIdDepartamento()}'";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }
}


