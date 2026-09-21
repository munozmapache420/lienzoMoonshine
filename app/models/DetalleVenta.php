<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase DetalleVenta (diagrama de clases) / tabla "detalle_venta"
 */
class DetalleVenta {
    private $conn;
    private $table_name = "detalle_venta";

    public $id;
    public $cantidad;
    public $precioUnitario;
    public $fechaRegistro;
    public $subtotal;
    public $venta_id;
    public $producto_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function calcularSubtotal() {
        $this->subtotal = $this->cantidad * $this->precioUnitario;
        return $this->subtotal;
    }

    public function asignarProducto($idProducto) {
        $this->producto_id = $idProducto;
        $stmt = $this->conn->prepare("SELECT precio_venta FROM producto WHERE id = :id");
        $stmt->execute([':id' => $idProducto]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->precioUnitario = (float)$row['precio_venta'];
        }
        return $this->producto_id;
    }

    public function actualizarCantidad($cantidad) {
        $this->cantidad = (int)$cantidad;
        $this->calcularSubtotal();
        return $this->cantidad;
    }

    public function guardar($ventaId) {
        $this->venta_id = $ventaId;
        $this->fechaRegistro = $this->fechaRegistro ?? date('Y-m-d');
        $this->calcularSubtotal();

        $query = "INSERT INTO " . $this->table_name . "
                  (venta_id, producto_id, cantidad, precio_unitario, fecha_registro, subtotal)
                  VALUES (:venta_id, :producto_id, :cantidad, :precio_unitario, :fecha_registro, :subtotal)";
        $stmt = $this->conn->prepare($query);
        $ok = $stmt->execute([
            ':venta_id'        => $this->venta_id,
            ':producto_id'     => $this->producto_id,
            ':cantidad'        => $this->cantidad,
            ':precio_unitario' => $this->precioUnitario,
            ':fecha_registro'  => $this->fechaRegistro,
            ':subtotal'        => $this->subtotal
        ]);

        // Descontar del stock del producto
        $stmtStock = $this->conn->prepare("UPDATE producto SET stock = GREATEST(stock - :cantidad, 0) WHERE id = :id");
        $stmtStock->execute([':cantidad' => $this->cantidad, ':id' => $this->producto_id]);

        return $ok;
    }

    public function leerPorVenta($ventaId) {
        $query = "SELECT d.*, p.nombre AS producto_nombre
                  FROM " . $this->table_name . " d
                  LEFT JOIN producto p ON p.id = d.producto_id
                  WHERE d.venta_id = :venta_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':venta_id' => $ventaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
