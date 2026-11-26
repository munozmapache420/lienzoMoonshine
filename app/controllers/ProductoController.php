
<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../../config/supabase.php';

class ProductoController {

    public $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function index() {
        $productos = $this->producto->getAll();
        require_once __DIR__ . '/../views/productos/index.php';
    }
    public function listarJSON(){
        header("content-type: application/json; charset=uft-8");
        $producto = new producto();
        $productos = $producto->getAll();
        echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function crear() {
        require_once __DIR__ . '/../views/productos/crear.php';
    }

    public function guardar() {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'] ?? '';
        $categoria_id = $_POST['categoria_id'] ?? null;
        $id_inventario = $_POST['id_inventario'] ?? null;
        $stock_minimo = $_POST['stock_minimo'] ?? 0;
        $estado = $_POST['estado'] ?? 'activo';
        $precio_compra = $_POST['precio_compra'] ?? 0;
        $precio_venta = $_POST['precio_venta'] ?? 0;
        $stock = $_POST['stock'] ?? 0;

        $resultado = $this->producto->guardar(
            $nombre,
            $descripcion,
            $categoria_id,
            $id_inventario,
            $precio_compra,
            $precio_venta,
            $stock,
            $stock_minimo,
            $estado
        );

        if ($resultado) {
            header('Location: /productos');
            exit;
        } else {
            echo "Error al guardar el producto";
        }
    }

    public function actualizar() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria_id'] ?? null;
            $id_inventario = $_POST['id_inventario'] ?? null;
            $stock_minimo = $_POST['stock_minimo'] ?? 0;
            $estado = $_POST['estado'] ?? 'activo';
            $precio_compra = $_POST['precio_compra'] ?? 0;
            $precio_venta = $_POST['precio_venta'] ?? 0;
            $stock = $_POST['stock'] ?? 0;

            if (!$id) {
                echo "Error: falta el ID del producto";
                return;
            }

            $resultado = $this->producto->actualizar(
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
            );

            if ($resultado) {
                header('Location: /productos');
                exit;
            } else {
                echo "Error al actualizar el producto";
            }
        }
    }

    public function subirImagen() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $maxBytes = 5 * 1024 * 1024;
        $permitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            'image/gif'  => 'gif',
        ];

        try {
            if (!$id) {
                throw new Exception('Producto no válido.');
            }
            $producto = $this->producto->getById($id);
            if (!$producto) {
                throw new Exception('El producto no existe.');
            }
            if (!isset($_FILES['imagen'])) {
                throw new Exception('No se recibió la imagen (revisa upload_max_filesize y post_max_size en php.ini).');
            }
            if ($_FILES['imagen']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['imagen']['error'] === UPLOAD_ERR_FORM_SIZE) {
                throw new Exception('La imagen es demasiado grande (máximo 5 MB).');
            }
            if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('No se pudo recibir la imagen (código ' . $_FILES['imagen']['error'] . ').');
            }

            $archivo = $_FILES['imagen'];
            if ($archivo['size'] > $maxBytes) {
                throw new Exception('La imagen no puede superar 5 MB.');
            }

            // Se valida el tipo real del archivo, no el que declara el navegador
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($archivo['tmp_name']);
            if (!isset($permitidos[$mime])) {
                throw new Exception('La imagen debe ser JPG, PNG, WEBP o GIF.');
            }

            $nombreObjeto = 'producto-' . $id . '-' . time() . '.' . $permitidos[$mime];

            $storage = new SupabaseStorage();
            $urlNueva = $storage->subir($archivo['tmp_name'], $nombreObjeto, $mime);

            try {
                $this->producto->actualizarImagen($id, $urlNueva);
            } catch (Exception $e) {
                // No dejar la imagen huérfana en Supabase si la base de datos falló
                $storage->borrarPorUrl($urlNueva);
                throw $e;
            }

            // Se elimina la imagen anterior para no acumular archivos huérfanos
            $col = $this->producto->columnaImagen();
            if ($col && !empty($producto->$col)) {
                $storage->borrarPorUrl($producto->$col);
            }

            $_SESSION['flash'] = ['tipo' => 'success', 'msg' => 'Imagen actualizada correctamente.'];
        } catch (Exception $e) {
            $_SESSION['flash'] = ['tipo' => 'danger', 'msg' => $e->getMessage()];
        }

        header('Location: /productos');
        exit;
    }

    public function eliminar(){
        $id =$_POST['id'];
        $producto = $this->producto->getById($id);
        require_once __DIR__ . '/../views/productos/eliminar.php';
    }

    public function editar() {
    
    $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    $id =$_GET['id'];
    $productos= $this->producto->getById($id);
    require_once __DIR__ . '/../views/productos/editar.php';
    }
}
