<?php
require_once __DIR__ . '/../../config/database.php';

class Producto
{
    public $conn;
  
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
public function getAll()
{
    $sql = "SELECT * FROM producto";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function guardar($nombre, $descripcion, $categoria_id, $id_inventario, $precio_compra, $precio_venta, $stock, $stock_minimo, $estado)
{
    try {
        $sql = "INSERT INTO producto (nombre,descripcion,categoria_id,id_inventario,precio_compra,precio_venta,stock,stock_minimo,estado) VALUES (:nombre,:descripcion,:categoria_id,:id_inventario,:precio_compra,:precio_venta,:stock,:stock_minimo,:estado)";
        $consulta = $this->conn->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':categoria_id', $categoria_id);
        $consulta->bindParam(':id_inventario', $id_inventario);
        $consulta->bindParam(':precio_compra', $precio_compra);
        $consulta->bindParam(':precio_venta', $precio_venta);
        $consulta->bindParam(':stock', $stock);
        $consulta->bindParam(':stock_minimo', $stock_minimo);
        $consulta->bindParam(':estado', $estado);
        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Error PRODUCTO: " . $nombre . " ERROR SQL: " . $e->getMessage();
    }
}
    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM producto WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }


}