<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase HistorialCompra (diagrama de clases) / tabla "historial_compra"
 */
class HistorialCompra {
    private $conn;
    private $table_name = "historial_compra";

    public $idHistorialCompra;
    public $fechaRegistro;
    public $totalCompra;
    public $cliente_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function agregarCompra($compra) {
        // $compra = ['cliente_id' => .., 'venta_id' => .., 'total' => ..]
        $query = "INSERT INTO " . $this->table_name . " (cliente_id, fecha_registro, total_compra) VALUES (:cliente_id, :fecha, :total)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':cliente_id' => $compra['cliente_id'] ?? null,
            ':fecha'      => $compra['fecha'] ?? date('Y-m-d'),
            ':total'      => $compra['total'] ?? 0
        ]);
        $this->idHistorialCompra = $this->conn->lastInsertId();

        if (!empty($compra['venta_id'])) {
            $link = $this->conn->prepare("INSERT INTO historial_compra_venta (historial_compra_id, venta_id) VALUES (:h, :v)");
            $link->execute([':h' => $this->idHistorialCompra, ':v' => $compra['venta_id']]);
        }

        return $this->idHistorialCompra;
    }

    public function obtenerCompras($clienteId = null) {
        if ($clienteId) {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE cliente_id = :cliente_id ORDER BY fecha_registro DESC");
            $stmt->execute([':cliente_id' => $clienteId]);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY fecha_registro DESC");
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calcularTotal($clienteId) {
        $stmt = $this->conn->prepare("SELECT COALESCE(SUM(total_compra),0) AS total FROM " . $this->table_name . " WHERE cliente_id = :cliente_id");
        $stmt->execute([':cliente_id' => $clienteId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (float)$row['total'];
    }
}
