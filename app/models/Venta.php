<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase Venta (diagrama de clases) / tabla "venta"
 */
class Venta {
    public $conn;
    private $table_name = "venta";

    public $id;
    public $fecha;
    public $total;
    public $cliente_id;
    public $usuario_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function calcularTotal() {
        $stmt = $this->conn->prepare("SELECT COALESCE(SUM(subtotal),0) AS total FROM detalle_venta WHERE venta_id = :id");
        $stmt->execute([':id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->total = (float)$row['total'];
        return $this->total;
    }

    public function registrarVenta($datos) {
        $query = "INSERT INTO " . $this->table_name . " (cliente_id, usuario_id, fecha, total) VALUES (:cliente_id, :usuario_id, :fecha, :total)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':cliente_id' => $datos['cliente_id'] ?? null,
            ':usuario_id' => $datos['usuario_id'],
            ':fecha'      => $datos['fecha'] ?? date('Y-m-d'),
            ':total'      => $datos['total'] ?? 0
        ]);
        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function anularVenta($id) {
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET anulada = 1 WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function leer() {
        $query = "SELECT v.*, c.nombre AS cliente_nombre, u.nombre AS usuario_nombre
                  FROM " . $this->table_name . " v
                  LEFT JOIN clientes c ON c.id = v.cliente_id
                  LEFT JOIN usuarios u ON u.id = v.usuario_id
                  ORDER BY v.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
