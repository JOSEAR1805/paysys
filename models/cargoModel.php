<?php

class cargoModel {

    private $id_cargo;
    private $nombre_cargo;
    private $salario_base;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
    }

    // GET
    function getIdCargo() { 
        return $this->id_cargo; 
    }

    function getNombreCargo() { 
        return $this->nombre_cargo; 
    }

    function getSalarioBase() { 
        return $this->salario_base; 
    }

    // SET
    function setIdCargo($id) { 
        $this->id_cargo = $id; 
    }

    function setNombreCargo($nombre ) { 
        $this->nombre_cargo = $nombre; 
    }

    function setSalarioBase($salario) { 
        $this->salario_base = $salario; 
    }

    public function get_cargos() {
        $query = "SELECT * FROM tb_cargos";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_cargo_id() {
        $query = "SELECT * FROM tb_cargos WHERE id_cargo = '{$this->getIdCargo()}'";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function guardar() {
        $query = "INSERT INTO tb_cargos (nombre_cargo, salario_base)
        VALUES ('{$this->getNombreCargo()}', '{$this->getSalarioBase()}')";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function editar() {
        $query = "UPDATE tb_cargos SET nombre_cargo='{$this->getNombreCargo()}', salario_base='{$this->getSalarioBase()}' WHERE id_cargo={$this->getIdCargo()}";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }
}