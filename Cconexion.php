<?php
class Conexion {
    private static $conexion = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                $host = 'dpg-d1napbqdbo4c73fvjt0g-a.oregon-postgres.render.com';
                $port = '5433';
                $dbname = 'ClinicaSalud';
                $user = 'postgres';
                $password = 'cE8pCJJ3zUIRViynRXwIUVx8vLjgrcmj';

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$conexion = new PDO($dsn, $user, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit(' Error al conectar con la base de datos: ' . $e->getMessage());
            }
        }
        return self::$conexion;
    }

    public static function desconectar() {
        self::$conexion = null;
    }
}
?>
