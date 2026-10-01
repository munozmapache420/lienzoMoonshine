<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController {
    public $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function index() {
        $productos = $this->producto->getAll();   
        require_once __DIR__ . '/../views/productos/index.php';
    }

    public function crear() {
     require_once __DIR__ . '/../views/productos/crear.php';
    }

    public function guardar() {
    
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria_id'];
            $id_inventario = $_POST['id_inventario'];
            $stock_minimo = $_POST['stock_minimo'];
            $estado = $_POST['estado'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $stock = $_POST['stock'];

            $producto = new Producto();
            $resultado = $producto->guardar($nombre, $descripcion, $categoria_id, $id_inventario, $precio_compra, $precio_venta, $stock, $stock_minimo, $estado);

            if ($resultado) {
                echo "producto guardado correctamente";
                $this->index();
            
        } else {
            echo "error al guardar el producto";
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

    
}
