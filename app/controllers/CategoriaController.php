<?php
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    public $categoria;

    public function __construct() {
        $this->categoria = new Categoria();
    }

public function index()
{
    $categorias = $this->categoria->getAll();
    require_once __DIR__ . '/../views/categorias/index.php';
}


    public function crear() {
     require_once __DIR__ . '/../views/categorias/crear.php';
    }

    public function guardar()
{
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $categoria = new Categoria();

    $resultado = $categoria->guardar($nombre, $descripcion, $precio);
    if ($resultado) {
        echo "categoria guardada correctamente";
        $this->index();
    } else {
        echo "error al guardar la categoria";
    }
}



}
