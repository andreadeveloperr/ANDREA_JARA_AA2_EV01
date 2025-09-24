<?php

class Database {
    private $host = "localhost";

    private $db_name = "libreta";

    private $db_name = "root";

    private $password = "";

    private $conn;

    public function conectar(): void {
        $this->conn=null;
        try{
            $dsn="mysql:host=".$this->host.";dbname=".$this->db_name . ";charset+utf8";
            $this->conn=new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
            $this->conn->exec(statement: "set names utf8");


        }catch(PDOExeption $e){
            echo "Error de conexion: ".$e->getMessage();

        }
        return $this->conn;

    }
    



}

?>