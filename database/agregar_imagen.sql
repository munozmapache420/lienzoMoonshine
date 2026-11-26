-- Ejecutar solo si la columna aún no existe
ALTER TABLE producto ADD COLUMN imagen VARCHAR(500) NULL AFTER nombre;
