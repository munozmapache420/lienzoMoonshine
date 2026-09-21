### huber stiven useche muñoz
# 20/08/2026
se crearon la estructura junto a su conexion de phpMyAdmin junto ala vinculacion del github

---

## Actualización — Estructura de base de datos y diagrama de clases

Se reestructuró el proyecto para que la base de datos y el código (modelos, controladores y
vistas) cumplan con el diagrama de base de datos (phpMyAdmin) y el diagrama de clases UML
entregados.

### Base de datos

El script `database/moonshine_v2.sql` crea la base `moonshine_v2` con las tablas:

- `roles`
- `usuarios` (con `rol_id` → FK a `roles`)
- `clientes`
- `categorias`
- `inventario`
- `producto` (con `fk_producto_categoria` y `id_inventario`)
- `venta`
- `detalle_venta`
- `metodo_pago`
- `historial_compra` y `historial_compra_venta`

Importa el archivo `database/moonshine_v2.sql` en phpMyAdmin (o vía `mysql -u root -p < database/moonshine_v2.sql`)
antes de ejecutar el proyecto. Los datos de conexión están en `config/database.php`.

### Estructura del proyecto

```
empresaMoonshine/
├── config/
│   └── database.php
├── database/
│   └── moonshine_v2.sql
├── public/
│   └── index.php          (gestión de usuarios / página principal)
├── app/
│   ├── controllers/
│   │   ├── UsuarioController.php
│   │   ├── ProductoController.php
│   │   ├── CategoriaController.php
│   │   ├── ClienteController.php
│   │   └── VentaController.php
│   ├── models/
│   │   ├── Usuario.php          (clase base del diagrama)
│   │   ├── Administrador.php    (hereda de Usuario)
│   │   ├── Cliente.php
│   │   ├── Categoria.php
│   │   ├── Inventario.php
│   │   ├── Producto.php
│   │   ├── Venta.php
│   │   ├── DetalleVenta.php
│   │   ├── HistorialCompra.php
│   │   └── MetodoPago.php
│   └── views/
│       ├── usuarios/
│       ├── productos/
│       ├── categorias/
│       ├── clientes/
│       └── ventas/
└── css/
    └── style.css

### Diagrama de clases → código

Cada clase del diagrama UML tiene su modelo PHP correspondiente en `app/models/`, con los mismos
atributos y métodos descritos en el diagrama (`iniciarSesion`, `registrarProducto`,
`calcularStockTotal`, `calcularSubtotal`, `agregarCompra`, `registrarVenta`, etc.). Los
controladores en `app/controllers/` exponen estas operaciones a las vistas PHP en `app/views/`.
