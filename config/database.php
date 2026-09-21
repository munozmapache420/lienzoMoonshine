<?php

class Database
{
    private $host = "localhost";
    private $db_name = "moonshine_v2";
    private $username = "root";
    private $password = "";

    public function getConnection()
    {
        try {

            $conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch (PDOException $e) {

            echo "Error de conexión: " . $e->getMessage();

            return null;
        }
    }
}
?>