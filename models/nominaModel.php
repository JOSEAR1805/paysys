<?php

class nominaModel{

    private $id;
    private $nombre;
    private $apellido;
    private $cedula;
    private $telefono;
    private $correo;
    private $direccion;
    private $departamento_id;
    private $cargo_id;
    private $salario_base;
    private $trabajador_id;
    public $fecha_mes_ini;
    public $fecha_mes_fin;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
        $this->fecha_mes_ini = date('Y-m').'-01';
        $this->fecha_mes_fin = date("Y-m-t", strtotime($this->fecha_mes_ini));
    }

    function getId() { 
        return $this->id; 
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

    function getDepartamento_id() { 
        return $this->departamento_id; 
    }

    function getCargo_id() { 
        return $this->cargo_id; 
    }

    function getTrabajador_id() { 
        return $this->trabajador_id; 
    }

    function getSalario_base() {
        return $this->salario_base;
    }

    function setId($id) { 
        $this->id = $id; 
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

    function setDepartamento_id($departamento_id) { 
        $this->departamento_id = $departamento_id; 
    }
    
    function setCargo_id($cargo_id) { 
        $this->cargo_id = $cargo_id; 
    }

    function setTrabajador_id($trabajador_id) { 
        $this->trabajador_id = $trabajador_id; 
    }

    function setSalario_base($salario_base) {
        return $this->salario_base = $salario_base;
    }


    function buscar_trabajador(){
        $query = "SELECT t1.id_trabajador, t2.nombre, t2.apellido, t2.cedula, t3.nombre_departamento, t4.nombre_cargo, t4.salario_base FROM tb_trabajadores AS t1
        LEFT JOIN tb_personas AS t2 ON t2.id_persona = t1.persona_id
        LEFT JOIN tb_departamentos AS t3 ON t3.id_departamento = t1.departamento_id
        LEFT JOIN tb_cargos AS t4 ON t4.id_cargo = t1.cargo_id
        WHERE t2.cedula = '{$this->getCedula()}' AND t1.estado_trabajador = TRUE";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;       
    }

    function buscar_body_nomina() {
        $query = "SELECT * FROM tb_detalles_pagos 
            WHERE trabajador_id = {$this->getTrabajador_id()} OR trabajador_id = 0 AND fecha BETWEEN '{$this->fecha_mes_ini}' AND '{$this->fecha_mes_fin}';";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;     
    }
   
    
}

?>