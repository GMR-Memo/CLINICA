<?php
/**
 * Clase para manejar la conexión a PostgreSQL mediante PDO
 */
class Conexion {
    private static $servidor  = 'localhost';
    private static $puerto    = '5433';
    private static $bd        = 'ClinicaSalud';
    private static $usuario   = 'postgres';
    private static $password  = 'root1234';
    private static $conexion  = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                $dsn = "pgsql:host=" . self::$servidor
                     . ";port=" . self::$puerto
                     . ";dbname=" . self::$bd;
                self::$conexion = new PDO($dsn, self::$usuario, self::$password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit('Error de conexión: ' . $e->getMessage());
            }
        }
        return self::$conexion;
    }

    public static function desconectar() {
        self::$conexion = null;
    }
}
?>
