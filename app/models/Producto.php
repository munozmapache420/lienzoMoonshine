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
        $sql = "DELETE FROM producto WHERE id = :id";
        return $sql([':id' => $id]);
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM producto WHERE id = :id";

            $consulta = $this->conn->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al buscar el PRODUCTO con ID: " . $e->getMessage();
        }
    }

    private $colImagen = null;

    /**
     * Devuelve el nombre real de la columna de imagen de la tabla producto
     * (imagen, imagen_url, img_url, foto...) o false si no existe.
     */
    public function columnaImagen()
    {
        if ($this->colImagen !== null) {
            return $this->colImagen;
        }

        $cols = $this->conn->query("SHOW COLUMNS FROM producto")->fetchAll(PDO::FETCH_COLUMN);

        foreach (['imagen', 'imagen_url', 'img_url', 'url_imagen', 'imagen_producto', 'foto', 'url'] as $c) {
            if (in_array($c, $cols, true)) {
                return $this->colImagen = $c;
            }
        }
        foreach ($cols as $c) {
            if (preg_match('/imagen|img|foto/i', $c)) {
                return $this->colImagen = $c;
            }
        }
        return $this->colImagen = false;
    }

    public function actualizarImagen($id, $url)
    {
        $col = $this->columnaImagen();
        if (!$col) {
            throw new Exception("La tabla producto no tiene columna de imagen. Ejecuta en phpMyAdmin: ALTER TABLE producto ADD COLUMN imagen VARCHAR(500) NULL;");
        }

        try {
            $sql = "UPDATE producto SET `$col` = :imagen WHERE id = :id";
            $consulta = $this->conn->prepare($sql);
            $consulta->execute([':imagen' => $url, ':id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error SQL al guardar la imagen en la columna `$col`: " . $e->getMessage());
        }
    }

    public function actualizar(
        $id,
        $nombre,
        $descripcion,
        $categoria_id,
        $id_inventario,
        $stock_minimo,
        $estado,
        $precio_compra,
        $precio_venta,
        $stock
    ) {
        try {
            $sql = "UPDATE producto SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    categoria_id = :categoria_id,
                    id_inventario = :id_inventario,
                    stock_minimo = :stock_minimo,
                    estado = :estado,
                    precio_compra = :precio_compra,
                    precio_venta = :precio_venta,
                    stock = :stock
                WHERE id = :id";

            $consulta = $this->conn->prepare($sql);

            return $consulta->execute([
                ':id' => $id,
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':categoria_id' => $categoria_id,
                ':id_inventario' => $id_inventario,
                ':stock_minimo' => $stock_minimo,
                ':estado' => $estado,
                ':precio_compra' => $precio_compra,
                ':precio_venta' => $precio_venta,
                ':stock' => $stock
            ]);
        } catch (PDOException $e) {
            echo "Error al actualizar el producto: " . $e->getMessage();
            return false;
        }
    }
}