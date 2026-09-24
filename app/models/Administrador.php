<?php
require_once __DIR__ . '/Usuario.php';
require_once __DIR__ . '/Producto.php';


class Administrador extends Usuario {

    public function registrarProducto($producto) {
        $productoModel = new Producto();
        return $productoModel->crear($producto);
    }

    public function actualizarProducto($id, $producto) {
        $productoModel = new Producto();
        return $productoModel->actualizar($id, $producto);
    }

    public function eliminarProducto($idProducto) {
        $productoModel = new Producto();
        return $productoModel->eliminar($idProducto);
    }

    public function registrarEmpleado($empleado) {
        return $this->crear($empleado);
    }

    public function eliminarEmpleado($idEmpleado) {
        return $this->eliminar($idEmpleado);
    }

    public function generarReporteInventario() {
        $query = "SELECT p.id, p.nombre, p.stock, p.stock_minimo, c.nombre AS categoria
                  FROM producto p
                  LEFT JOIN categorias c ON c.id = p.categoria_id
                  ORDER BY p.nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function configurarSistema($opciones = []) {
        return true;
    }

    public function gestionarUsuarios() {
        return $this->leer();
    }

    public function generarReportes() {
        $ventas = $this->conn->query("SELECT COUNT(*) AS total_ventas, COALESCE(SUM(total),0) AS total_ingresos FROM venta WHERE anulada = 0")->fetch(PDO::FETCH_ASSOC);
        $productos = $this->conn->query("SELECT COUNT(*) AS total_productos FROM producto")->fetch(PDO::FETCH_ASSOC);
        $clientes = $this->conn->query("SELECT COUNT(*) AS total_clientes FROM clientes")->fetch(PDO::FETCH_ASSOC);
        return array_merge($ventas, $productos, $clientes);
    }
}
