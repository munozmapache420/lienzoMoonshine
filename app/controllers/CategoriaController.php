<?php
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    private $categoria;

    public function __construct() {
        $this->categoria = new Categoria();
    }

    public function index() {
        return $this->categoria->leer();
    }

    public function crear($datos) {
        try {
            return $this->categoria->crearCategoria($datos);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>alert('Ya existe una categoría con ese nombre.'); window.history.back();</script>";
                exit;
            }
            throw $e;
        }
    }

    public function obtenerPorId($id) {
        return $this->categoria->leerUno((int)$id);
    }

    public function actualizar($id, $datos) {
        return $this->categoria->actualizarCategoria((int)$id, $datos);
    }

    public function eliminar($id) {
        try {
            return $this->categoria->eliminar((int)$id);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>
                    alert('No se puede eliminar esta categoría porque tiene productos asociados.');
                    window.location.href = 'index.php';
                </script>";
                exit;
            }
            throw $e;
        }
    }
}
