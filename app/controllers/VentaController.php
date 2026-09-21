<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/DetalleVenta.php';
require_once __DIR__ . '/../models/MetodoPago.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Usuario.php';

class VentaController {
    private $venta;

    public function __construct() {
        $this->venta = new Venta();
    }

    public function index() {
        return $this->venta->leer();
    }

    public function productos() {
        return (new Producto())->leer();
    }

    public function clientes() {
        return (new Cliente())->leer();
    }

    public function detalle($ventaId) {
        return (new DetalleVenta())->leerPorVenta($ventaId);
    }

    public function registrarVentaCompleta($datos) {
        $conn = $this->venta->conn;
        try {
            $conn->beginTransaction();

            $ventaId = $this->venta->registrarVenta([
                'cliente_id' => $datos['cliente_id'] ?? null,
                'usuario_id' => $datos['usuario_id'],
                'fecha'      => date('Y-m-d'),
                'total'      => 0
            ]);

            $totalVenta = 0;
            foreach ($datos['productos'] as $item) {
                $detalle = new DetalleVenta();
                $detalle->asignarProducto((int)$item['id']);
                $detalle->actualizarCantidad((int)$item['cantidad']);
                $detalle->fechaRegistro = date('Y-m-d');
                $detalle->guardar($ventaId);
                $totalVenta += $detalle->subtotal;
            }

            $conn->prepare("UPDATE venta SET total = :total WHERE id = :id")
                 ->execute([':total' => $totalVenta, ':id' => $ventaId]);

            if (!empty($datos['metodo_pago'])) {
                $metodoPago = new MetodoPago();
                $metodoPago->registrarVenta($ventaId, $datos['metodo_pago']);
            }

            $conn->commit();
            return $ventaId;
        } catch (Exception $e) {
            $conn->rollBack();
            echo "<script>alert('Error al registrar la venta: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
        }
    }

    public function anular($id) {
        return $this->venta->anularVenta((int)$id);
    }
}
