<?php

class Database {

    private $host;
    private $port;
    private $user;
    private $pass;
    private $db;
    public $pgconn;

    public function __construct() {
        $this->host = "localhost";
        $this->port = 5432;
        $this->user = "root";
        $this->pass = "Secret2020";
        $this->db = "db_paysys";
    }

    public function connect() {
        $this->pgconn = pg_connect("host=".$this->host." port=".$this->port." user=".$this->user." password=".$this->pass." dbname=".$this->db." options='--client_encoding=UTF8'") or die ("ERROR DE CONEXION");
        return $this->pgconn;
    }

    public function destroy() {
        pg_close($this->pgconn);
    }

}

?>