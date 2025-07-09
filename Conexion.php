<?php
class Conexion {
    private static $conexion = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                // Detectamos si estamos en producción (Render) o local
                $is_produccion = isset($_ENV['RENDER']) || strpos($_SERVER['HTTP_HOST'] ?? '', 'render.com') !== false;

                if ($is_produccion) {
                    // Configuración para RENDER
                    $host = 'dpg-d1napbqdbo4c73fvjt0g-a.oregon-postgres.render.com';
                    $port = '5432'; // Puerto correcto de Render
                    $dbname = 'clinicasalud';
                    $user = 'memo';
                    $password = 'cE8pCJJ3zUIRViynRXwIUVx8vLjgrcmj';
                } else {
                    // Configuración para LOCAL
                    $host = 'localhost';
                    $port = '5433'; // Cambia si tu PostgreSQL local usa otro puerto
                    $dbname = 'ClinicaSalud';
                    $user = 'postgres';
                    $password = 'root1234'; // Tu contraseña local
                }

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$conexion = new PDO($dsn, $user, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit('❌ Error al conectar con la base de datos: ' . $e->getMessage());
            }
        }
        return self::$conexion;
    }

    public static function desconectar() {
        self::$conexion = null;
    }
}
?>
