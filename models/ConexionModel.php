<?php

class ConexionModel {

    private $dsn;
    private $user = LDB_USER;
    private $password = LDB_PASS;
    private $dbname = LDB_NAME;
    private $engine = LDB_ENGINE;
    private $host = LDB_HOST;
    private $conn;

    public function __construct()
    {
        $this->dsn = $this->engine . ":host=$this->host;dbname=$this->dbname";

        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $ex) {
            throw new Exception("Error de conexión: " . $ex->getMessage());
        }
    }

    public function getConexion(){
        return $this->conn;
    }

    public function closeConexion() {
        $this->conn = null;
    }
}
