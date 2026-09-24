<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase MetodoPago (diagrama de clases) / tabla "metodo_pago"
 */
class MetodoPago {
    private $conn;
    private $table_name = "metodo_pago";

    public $idMetodoPago;
    public $tipo;
    public $total;
    public $fecha;
    public $venta_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function calcularTotal() {
        $stmt = $this->conn->prepare("SELECT total FROM venta WHERE id = :id");
        $stmt->execute([':id' => $this->venta_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->total = $row ? (float)$row['total'] : 0;
        return $this->total;
    }

    public function registrarVenta($ventaId, $tipo) {
        $this->venta_id = $ventaId;
        $this->tipo = $tipo;
        $this->fecha = date('Y-m-d');
        $this->calcularTotal();

        $query = "INSERT INTO " . $this->table_name . " (venta_id, tipo, total, fecha) VALUES (:venta_id, :tipo, :total, :fecha)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':venta_id' => $this->venta_id,
            ':tipo'     => $this->tipo,
            ':total'    => $this->total,
            ':fecha'    => $this->fecha
        ]);
        $this->idMetodoPago = $this->conn->lastInsertId();
        return $this->idMetodoPago;
    }
}
