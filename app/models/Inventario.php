<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase Inventario (diagrama de clases) / tabla "inventario"
 */
class Inventario {
    private $conn;
    private $table_name = "inventario";

    public $id;
    public $fechaActualizacion;
    public $tipo;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function verificarDisponibilidad($idProducto) {
        $stmt = $this->conn->prepare("SELECT stock FROM producto WHERE id = :id");
        $stmt->execute([':id' => $idProducto]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? ((int)$row['stock'] > 0) : false;
    }

    public function actualizarStock($idProducto, $cantidad) {
        $stmt = $this->conn->prepare("UPDATE producto SET stock = :stock WHERE id = :id");
        $ok = $stmt->execute([':stock' => $cantidad, ':id' => $idProducto]);
        $this->tocarInventario();
        return $ok;
    }

    public function registrarMovimiento($tipo = 'entrada') {
        $query = "INSERT INTO " . $this->table_name . " (fecha_actualizacion, tipo) VALUES (CURDATE(), :tipo)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':tipo' => $tipo]);
        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function revertirMovimiento($idMovimiento) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        return $stmt->execute([':id' => $idMovimiento]);
    }

    public function asociarLote($idProducto, $idInventario) {
        $stmt = $this->conn->prepare("UPDATE producto SET id_inventario = :id_inventario WHERE id = :id");
        return $stmt->execute([':id_inventario' => $idInventario, ':id' => $idProducto]);
    }

    public function calcularStock() {
        $stmt = $this->conn->query("SELECT COALESCE(SUM(stock),0) AS stock_total FROM producto");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['stock_total'];
    }

    private function tocarInventario() {
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET fecha_actualizacion = CURDATE() WHERE id = :id");
        if ($this->id) {
            $stmt->execute([':id' => $this->id]);
        }
    }
}
