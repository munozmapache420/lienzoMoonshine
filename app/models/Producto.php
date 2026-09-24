<?php
require_once __DIR__ . '/../../config/database.php';

class Producto
{
    private $conn;
    private $table_name = "producto";

    public $id;
    public $nombre;
    public $descripcion;
    public $categoria;
    public $stockMinimo;
    public $estado;
    public $PrecioCompra;
    public $precioVenta;
    public $stock;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function aumentarStock($cantidad)
    {
        $query = "UPDATE " . $this->table_name . " SET stock = stock + :cantidad WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':cantidad' => (int)$cantidad, ':id' => $this->id]);
    }

    public function disminuirStocks($cantidad)
    {
        $query = "UPDATE " . $this->table_name . " SET stock = GREATEST(stock - :cantidad, 0) WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':cantidad' => (int)$cantidad, ':id' => $this->id]);
    }

    public function actualizarPrecio($precioCompra, $precioVenta)
    {
        $query = "UPDATE " . $this->table_name . " SET precio_compra = :pc, precio_venta = :pv WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':pc' => $precioCompra, ':pv' => $precioVenta, ':id' => $this->id]);
    }

    public function verificarStockMinimo()
    {
        $stmt = $this->conn->prepare("SELECT stock, stock_minimo FROM " . $this->table_name . " WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return false;
        return ((int)$row['stock'] <= (int)$row['stock_minimo']);
    }

    public function calcularStockTotal()
    {
        $stmt = $this->conn->query("SELECT COALESCE(SUM(stock),0) AS total FROM " . $this->table_name);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    }


    public function leer()
    {
        $query = "SELECT p.*, c.nombre AS categoria_nombre
                  FROM " . $this->table_name . " p
                  LEFT JOIN categorias c ON c.id = p.categoria_id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($datos)
    {
        $query = "INSERT INTO " . $this->table_name . "
                  (nombre, descripcion, categoria_id, id_inventario, stock_minimo, estado, precio_compra, precio_venta, stock)
                  VALUES (:nombre, :descripcion, :categoria_id, :id_inventario, :stock_minimo, :estado, :precio_compra, :precio_venta, :stock)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre'        => $datos['nombre'],
            ':descripcion'   => $datos['descripcion'] ?? null,
            ':categoria_id'  => $datos['categoria_id'],
            ':id_inventario' => $datos['id_inventario'] ?? null,
            ':stock_minimo'  => $datos['stock_minimo'] ?? 0,
            ':estado'        => $datos['estado'] ?? 'activo',
            ':precio_compra' => $datos['precio_compra'] ?? 0,
            ':precio_venta'  => $datos['precio_venta'] ?? 0,
            ':stock'         => $datos['stock'] ?? 0
        ]);
    }

    public function actualizar($id, $datos)
    {
        $query = "UPDATE " . $this->table_name . " SET
                  nombre = :nombre, descripcion = :descripcion, categoria_id = :categoria_id,
                  stock_minimo = :stock_minimo, estado = :estado, precio_compra = :precio_compra,
                  precio_venta = :precio_venta, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'            => $id,
            ':nombre'        => $datos['nombre'],
            ':descripcion'   => $datos['descripcion'] ?? null,
            ':categoria_id'  => $datos['categoria_id'],
            ':stock_minimo'  => $datos['stock_minimo'] ?? 0,
            ':estado'        => $datos['estado'] ?? 'activo',
            ':precio_compra' => $datos['precio_compra'] ?? 0,
            ':precio_venta'  => $datos['precio_venta'] ?? 0,
            ':stock'         => $datos['stock'] ?? 0
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM producto";
        $consulta = $this->conn->query($sql);
    }
}