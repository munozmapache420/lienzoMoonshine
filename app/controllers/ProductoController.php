<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController {
    private $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function index() {
        return $this->producto->leer();
    }

    public function categorias() {
        $categoria = new Categoria();
        return $categoria->leer();
    }

    public function crear($datos) {
        try {
            return $this->producto->crear($this->normalizar($datos));
        } catch (PDOException $e) {
            echo "<script>alert('Error detallado de MySQL: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
        }
    }

    public function obtenerPorId($id) {
        return $this->producto->leerUno((int)$id);
    }

    public function actualizar($id, $datos) {
        try {
            return $this->producto->actualizar((int)$id, $this->normalizar($datos));
        } catch (PDOException $e) {
            echo "<script>alert('Error detallado de MySQL: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
        }
    }

    public function eliminar($id) {
        try {
            return $this->producto->eliminar((int)$id);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>
                    alert('No se puede eliminar este producto porque está asociado a ventas o movimientos.');
                    window.location.href = 'index.php';
                </script>";
                exit;
            }
            throw $e;
        }
    }

    private function normalizar($datos) {
        return [
            'nombre'        => trim($datos['nombre'] ?? ''),
            'descripcion'   => trim($datos['descripcion'] ?? ''),
            'categoria_id'  => (int)($datos['categoria_id'] ?? 0),
            'stock_minimo'  => (int)($datos['stock_minimo'] ?? 0),
            'estado'        => $datos['estado'] ?? 'activo',
            'precio_compra' => (float)($datos['precio_compra'] ?? 0),
            'precio_venta'  => (float)($datos['precio_venta'] ?? 0),
            'stock'         => (int)($datos['stock'] ?? 0),
        ];
    }
}
