<?php
require_once __DIR__ . '/../../config/database.php';


class Categoria
{
    public $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM categorias";
        $consulta = $this->conn->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
public function guardar($nombre, $descripcion, $precio)
{
    try {

        $sql = "INSERT INTO categorias (nombre,descripcion,precio) VALUES (:nombre,:descripcion,:precio)";
        $consulta = $this->conn->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':precio', $precio);

        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Error CATEGORIA: " . $nombre . " ERROR SQL: " . $e->getMessage();
    }
}



    public function crearCategoria($datos)
    {
        $query = "INSERT INTO categorias (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':precio'      => $datos['precio'] ?? 0
        ]);
    }

    public function actualizarCategoria($id, $datos)
    {
        $query = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'          => $id,
            ':nombre'      => $datos['nombre'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':precio'      => $datos['precio'] ?? 0
        ]);
    }


}
