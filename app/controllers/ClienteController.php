<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $cliente;

    public function __construct() {
        $this->cliente = new Cliente();
    }

    public function index() {
        return $this->cliente->leer();
    }

    public function crear($datos) {
        try {
            return $this->cliente->registroUnico($datos);
        } catch (PDOException $e) {
            echo "<script>alert('Error al registrar el cliente: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
        }
    }

    public function obtenerPorId($id) {
        return $this->cliente->leerUno((int)$id);
    }

    public function actualizar($id, $datos) {
        return $this->cliente->ActualizarDatos((int)$id, $datos);
    }

    public function eliminar($id) {
        try {
            return $this->cliente->eliminar((int)$id);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>
                    alert('No se puede eliminar este cliente porque tiene ventas asociadas.');
                    window.location.href = 'index.php';
                </script>";
                exit;
            }
            throw $e;
        }
    }
}
