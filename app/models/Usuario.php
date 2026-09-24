<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    protected $conn;
    protected $table_name = "usuarios";

    public $id;
    public $nombre;
    public $email;      
    public $contrasena;  
    public $usuario;    
    public $cargo;
    public $rol_id;
    public $activo;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM usuarios";

        $consulta = $this->conn->query($sql);

        return $consulta->fetchAll();
    }
    public function iniciarSesion($correo, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE correo = :correo AND password = :password AND activo = 1 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':correo' => $correo, ':password' => $password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->cargarDesdeFila($row);
            return true;
        }
        return false;
    }

    public function cerrarSeccion() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
        return true;
    }

    public function activar() {
        $query = "UPDATE " . $this->table_name . " SET activo = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $this->id]);
    }

    public function desactivar() {
        $query = "UPDATE " . $this->table_name . " SET activo = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $this->id]);
    }


    public function leer() {
        $query = "SELECT u.*, r.nombre AS rol_nombre FROM " . $this->table_name . " u
            LEFT JOIN roles r ON r.id = u.rol_id
            ORDER BY u.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerUno($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->cargarDesdeFila($row);
            return $row;
        }
        return false;
    }

    public function crear($datos) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, correo, password, cargo, rol_id)
                  VALUES (:nombre, :correo, :password, :cargo, :rol_id)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre'   => $datos['nombre'],
            ':correo'   => $datos['correo'],
            ':password' => $datos['password'],
            ':cargo'    => $datos['cargo'] ?? null,
            ':rol_id'   => $datos['rol_id'] ?? null
        ]);
    }

    public function actualizar($id, $datos) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, correo = :correo,
                  password = :password, cargo = :cargo, rol_id = :rol_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'       => $id,
            ':nombre'   => $datos['nombre'],
            ':correo'   => $datos['correo'],
            ':password' => $datos['password'],
            ':cargo'    => $datos['cargo'] ?? null,
            ':rol_id'   => $datos['rol_id'] ?? null
        ]);
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    protected function cargarDesdeFila($row) {
        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->email = $row['correo'];
        $this->contrasena = $row['password'];
        $this->usuario = $row['correo'];
        $this->cargo = $row['cargo'] ?? null;
        $this->rol_id = $row['rol_id'] ?? null;
        $this->activo = $row['activo'] ?? 1;
    }
}
