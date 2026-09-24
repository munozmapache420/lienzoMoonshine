<?php
require_once __DIR__ . '/../../config/database.php';

/**
 * Clase Cliente (diagrama de clases) / tabla "clientes"
 */
class Cliente {
    private $conn;
    private $table_name = "clientes";

    public $id;
    public $nombre;
    public $telefono;
    public $direccion;
    public $registroUnico;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

     public function getAll()
    {
        $sql = "SELECT * FROM clientes";

        $consulta = $this->conn->query($sql);

        return $consulta->fetchAll();
    }


    
    public function ActualizarDatos($id, $datos) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, telefono = :telefono, direccion = :direccion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'        => $id,
            ':nombre'    => $datos['nombre'],
            ':telefono'  => $datos['telefono'] ?? null,
            ':direccion' => $datos['direccion'] ?? null
        ]);
    }

    public function registroUnico($datos) {
        $codigo = 'CLI-' . strtoupper(uniqid());
        $query = "INSERT INTO " . $this->table_name . " (nombre, telefono, direccion, registro_unico) VALUES (:nombre, :telefono, :direccion, :codigo)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':nombre'    => $datos['nombre'],
            ':telefono'  => $datos['telefono'] ?? null,
            ':direccion' => $datos['direccion'] ?? null,
            ':codigo'    => $codigo
        ]);
        return $codigo;
    }

    public function leer() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY id DESC");
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
