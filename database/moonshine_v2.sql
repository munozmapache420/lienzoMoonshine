-- ============================================================
-- Base de datos: moonshine_v2
-- Empresa Moonshine
-- Estructura alineada con:
--   1) El diagrama de la base de datos (phpMyAdmin) proporcionado
--      (categorias, inventario, producto, roles, usuarios)
--   2) El diagrama de clases UML proporcionado
--      (usuario, administrador, cliente, producto, categoria,
--       inventario, venta, detalleVenta, historialCompra, metodoPago)
-- ============================================================

CREATE DATABASE IF NOT EXISTS moonshine_v2
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE moonshine_v2;

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- roles
-- ------------------------------------------------------------
DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO roles (nombre) VALUES ('administrador'), ('vendedor');

-- ------------------------------------------------------------
-- usuarios  (clase Usuario / Administrador del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nombre   VARCHAR(120) NOT NULL,
    correo   VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cargo    VARCHAR(60)  NULL,
    activo   TINYINT(1)   NOT NULL DEFAULT 1,
    rol_id   INT          NULL,
    CONSTRAINT fk_usuarios_rol
        FOREIGN KEY (rol_id) REFERENCES roles(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- clientes  (clase Cliente del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(120) NOT NULL,
    telefono       VARCHAR(30)  NULL,
    direccion      VARCHAR(200) NULL,
    registro_unico VARCHAR(60)  NOT NULL UNIQUE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- categorias  (clase Categoria del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    precio      DECIMAL(10,2) NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- inventario  (clase Inventario del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS inventario;
CREATE TABLE inventario (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    fecha_actualizacion DATE NOT NULL,
    tipo                VARCHAR(50) NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- producto  (clase Producto del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS producto;
CREATE TABLE producto (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nombre           VARCHAR(150) NOT NULL,
    descripcion      TEXT NULL,
    categoria_id     INT NOT NULL,
    id_inventario    INT NULL,
    stock_minimo     INT NOT NULL DEFAULT 0,
    estado           VARCHAR(30) NOT NULL DEFAULT 'activo',
    precio_compra    DECIMAL(10,2) NOT NULL DEFAULT 0,
    precio_venta     DECIMAL(10,2) NOT NULL DEFAULT 0,
    stock            INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_producto_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_producto_inventario
        FOREIGN KEY (id_inventario) REFERENCES inventario(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- venta  (clase Venta del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS venta;
CREATE TABLE venta (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id  INT NULL,
    usuario_id  INT NOT NULL,
    fecha       DATE NOT NULL,
    total       DECIMAL(10,2) NOT NULL DEFAULT 0,
    anulada     TINYINT(1) NOT NULL DEFAULT 0,
    CONSTRAINT fk_venta_cliente
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_venta_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- detalle_venta  (clase DetalleVenta del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS detalle_venta;
CREATE TABLE detalle_venta (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    venta_id         INT NOT NULL,
    producto_id      INT NOT NULL,
    cantidad         INT NOT NULL DEFAULT 1,
    precio_unitario  DECIMAL(10,2) NOT NULL DEFAULT 0,
    fecha_registro   DATE NOT NULL,
    subtotal         DECIMAL(10,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_detalleventa_venta
        FOREIGN KEY (venta_id) REFERENCES venta(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_detalleventa_producto
        FOREIGN KEY (producto_id) REFERENCES producto(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- metodo_pago  (clase MetodoPago del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS metodo_pago;
CREATE TABLE metodo_pago (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    tipo     ENUM('Efectivo','Transferencia','Tarjeta') NOT NULL,
    total    DECIMAL(10,2) NOT NULL DEFAULT 0,
    fecha    DATE NOT NULL,
    CONSTRAINT fk_metodopago_venta
        FOREIGN KEY (venta_id) REFERENCES venta(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- historial_compra  (clase HistorialCompra del diagrama de clases)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS historial_compra;
CREATE TABLE historial_compra (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id     INT NULL,
    fecha_registro DATE NOT NULL,
    total_compra   DECIMAL(10,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_historialcompra_cliente
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Relaciona cada compra (venta) registrada con su historial
DROP TABLE IF EXISTS historial_compra_venta;
CREATE TABLE historial_compra_venta (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    historial_compra_id INT NOT NULL,
    venta_id            INT NOT NULL,
    CONSTRAINT fk_hcv_historial
        FOREIGN KEY (historial_compra_id) REFERENCES historial_compra(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_hcv_venta
        FOREIGN KEY (venta_id) REFERENCES venta(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;

-- ------------------------------------------------------------
-- Datos de ejemplo
-- ------------------------------------------------------------
INSERT INTO usuarios (nombre, correo, password, cargo, rol_id) VALUES
('Huber Useche', 'huber@moonshine.com', 'admin123', 'Administrador', 1),
('Vendedor Uno', 'vendedor1@moonshine.com', 'venta123', 'Vendedor', 2);

INSERT INTO categorias (nombre, descripcion, precio) VALUES
('Cremas', 'Cremas artesanales', 0),
('Licores', 'Licores destilados', 0);

INSERT INTO inventario (fecha_actualizacion, tipo) VALUES
(CURDATE(), 'entrada');

INSERT INTO producto (nombre, descripcion, categoria_id, id_inventario, stock_minimo, estado, precio_compra, precio_venta, stock) VALUES
('Crema de Cacao', 'Crema artesanal de cacao', 1, 1, 5, 'activo', 15000, 25000, 20);

INSERT INTO clientes (nombre, telefono, direccion, registro_unico) VALUES
('Cliente Genérico', '3000000000', 'Sin dirección', 'CLI-0001');
