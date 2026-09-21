<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function index() {
        return $this->usuario->leer();
    }

    public function obtenerPorId($id) {
        $this->usuario->leerUno($id);
        return [
            'id' => $this->usuario->id,
            'nombre' => $this->usuario->nombre,
            'correo' => $this->usuario->email,
            'password' => $this->usuario->contrasena,
            'cargo' => $this->usuario->cargo,
            'rol_id' => $this->usuario->rol_id,
        ];
    }

    public function crear($datos) {
        try {
            return $this->usuario->crear($datos);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>alert('El correo ya está registrado. Intenta con otro.'); window.history.back();</script>";
                exit;
            }
            throw $e;
        }
    }

    public function actualizar($id, $datos) {
        return $this->usuario->actualizar($id, $datos);
    }

    public function eliminar($id) {
        try {
            return $this->usuario->eliminar($id);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>
                    alert('No se puede eliminar este usuario porque tiene ventas registradas asociadas.');
                    window.location.href = '../../../public/index.php';
                </script>";
                exit;
            }
            throw $e;
        }
    }

    public function roles() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->query("SELECT * FROM roles ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
