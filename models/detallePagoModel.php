<?php

class detallePagoModel{

    private $id_detalle;
    private $tipo_pago;
    private $descripcion;
    private $fecha;
    private $monto;
    private $trabajador_id;

    public $conexion;

    public function __construct() {
        $conexion = new Database;
        $this->conexion = $conexion->connect();
    }

    // GET 
    function getId_detalle() { 
        return $this->id_detalle; 
    }

    function getTipo_pago() {
        return $this->tipo_pago;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getMonto() {
        return $this->monto;
    }
    
    function getDirigido() {
        return $this->trabajador_id;
    }

    // SET
    function setId_detalle($id) { 
        $this->id_detalle = $id; 
    }

    function setTipo_pago($tipo_pago) {
        $this->tipo_pago = $tipo_pago;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setDirigido($dirigido) {
        $this->trabajador_id = $dirigido? $dirigido: 0;
    }


    public function get_detalles() {
        $query = "SELECT * FROM tb_detalles_pagos
        LEFT JOIN tb_trabajadores ON tb_trabajadores.id_trabajador = tb_detalles_pagos.trabajador_id
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_trabajadores.persona_id";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }

    public function get_detalles_id($id) {
        $query = "SELECT * FROM tb_detalles_pagos
        LEFT JOIN tb_trabajadores ON tb_trabajadores.id_trabajador = tb_detalles_pagos.trabajador_id
        LEFT JOIN tb_personas ON tb_personas.id_persona = tb_trabajadores.persona_id
        WHERE id_detalle = $id";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        return $result;
    }


    public function guardar() {
        $query = "INSERT INTO tb_detalles_pagos (tipo_pago, descripcion, fecha, monto, trabajador_id)
        VALUES ('{$this->getTipo_pago()}', '{$this->getDescripcion()}', '{$this->getFecha()}', '{$this->getMonto()}', '{$this->getDirigido()}')";
        $result = pg_query($this->conexion, $query) or die("Inserción Erronea: ".pg_last_error());
        
        return $result;
    }

    public function editar() {
        $query = "UPDATE tb_detalles_pagos SET tipo_pago='{$this->getTipo_pago()}', descripcion='{$this->getDescripcion()}', fecha ='{$this->getFecha()}', monto='{$this->getMonto()}', trabajador_id={$this->getDirigido()}  
        WHERE id_detalle= {$this->getId_detalle()}";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea ".pg_last_error());
        return $result;
    }

    public function eliminar() {
        $query = "DELETE  FROM tb_detalles_pagos WHERE id_detalle={$this->getId_detalle()}";

        $result = pg_query($this->conexion, $query) or die("Inserción Erronea 2: ".pg_last_error());
        return $result;
    }

}