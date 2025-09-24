<?php
require_once __DIR__ . '/ ../config/database.php';

class contactos{
    private $conn;
    private $table = "contactos";

    public function _construct(){
        $database = new Database();
        $this->conn = $database->conectar();

    }

    public function obtenerTodos(): void{
        $query="SELECT * FROM " . $this->table . "ORDER BY id DESC";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->execute();
        return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);


    }

    public function crear($nombre,$telefono,$direccion,$correo): void {
        $query = "INSERT INTO" . $this->table . "(nombre,telefono,direccion,correo,fecha_creacion) VALUES (:nombre, :telefono, :direccion, :correo, NOW())";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(param: "nombre", var: &$nombre);
        $stmt->bindParam(param: "telefono", var: &$telefono);
        $stmt->bindParam(param: "direccion", var: &$direccion);
        $stmt->bindParam(param: "correo", var: &$correo);
        return $stmt->execute();


  }

public function obtenerPorId($id): mixed {
        $query = "SELECT * FROM" . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(param: "id", var: &$id);
        $stmt->execute();
        return $stmt->fetch(mode: PDO::FETCH_ASSOC);



}



  public function actualizar($nombre,$telefono,$direccion,$correo): bool {
        $query = "INSERT INTO" . $this->table . " SET nombre = :nombre, telefono = :telefono, direccion = :direccion, correo = :correo WHERE id = :id";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(param: "id", var: &$id);
        $stmt->bindParam(param: "nombre", var: &$nombre);
        $stmt->bindParam(param: "telefono", var: &$telefono);
        $stmt->bindParam(param: "direccion", var: &$direccion);
        $stmt->bindParam(param: "correo", var: &$correo);
        return $stmt->execute();




  
}
public function eliminar($id): bool{
        $query = "DELETE FROM" . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(param: "id", var: &$id);
        return $stmt->execute();
}


}


?>