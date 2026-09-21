<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase Categoria (diagrama de clases) / tabla "categorias"
 */
class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function idcategoria() {
        return $this->id;
    }

    public function crearCategoria($datos) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':precio'      => $datos['precio'] ?? 0
        ]);
    }

    public function actualizarCategoria($id, $datos) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'          => $id,
            ':nombre'      => $datos['nombre'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':precio'      => $datos['precio'] ?? 0
        ]);
    }

    public function leer() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY nombre");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
