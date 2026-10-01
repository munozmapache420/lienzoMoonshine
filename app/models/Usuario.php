<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    public $conn;


    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

 public function getAll()
{
    $sql = "SELECT * FROM usuarios";

    $stmt = $this->conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 public function guardar($nombre, $correo, $password, $cargo, $activo, $rol_id)
    {
        try {

            $sql = "INSERT INTO usuarios
                    (nombre,correo,password,cargo,activo,rol_id)
                    VALUES
                    (:nombre,:correo,:password,:cargo,:activo,:rol_id)";

            $consulta = $this->conn->prepare($sql);

            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':correo', $correo);
            $consulta->bindParam(':password', $password);
            $consulta->bindParam(':cargo', $cargo);
            $consulta->bindParam(':activo', $activo);
            $consulta->bindParam(':rol_id', $rol_id);

            return $consulta->execute();

        } catch (PDOException $e) {

            echo "Error USUARIO: " . $nombre . " ERROR SQL: " . $e->getMessage();

        }
    }





    public function actualizar($id, $datos) {
        $query = "UPDATE usuarios SET nombre = :nombre, correo = :correo,
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
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }


}
