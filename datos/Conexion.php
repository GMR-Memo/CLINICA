<?php
/**
 * Clase para manejar la conexión a PostgreSQL mediante PDO
 */
class Conexion {
    private static $servidor  = 'dpg-d1napbqdbo4c73fvjt0g-a.oregon-postgres.render.com';
    private static $puerto    = '5432';
    private static $bd        = 'clinicasalud';
    private static $usuario   = 'memo';
    private static $password  = 'cE8pCJJ3zUIRViynRXwIUVx8vLjgrcmj';
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
