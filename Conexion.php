<?php
class Conexion {
    private static $conexion = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                $entorno = getenv('APP_ENV') ?: 'local';

                if ($entorno === 'local') {
                    $host = getenv('DB_HOST') ?: 'host.docker.internal';
                    $port = getenv('DB_PORT') ?: '5433';
                    $dbname = getenv('DB_NAME') ?: 'ClinicaSalud';
                    $user = getenv('DB_USER') ?: 'postgres';
                    $password = getenv('DB_PASSWORD') ?: 'root1234';
                } else {
                    // Producción Render (ajusta estas variables si quieres)
                    $host = getenv('DB_HOST') ?: 'dpg-d1napbqdbo4c73fvjt0g-a.oregon-postgres.render.com';
                    $port = getenv('DB_PORT') ?: '5432';
                    $dbname = getenv('DB_NAME') ?: 'clinicasalud';
                    $user = getenv('DB_USER') ?: 'memo';
                    $password = getenv('DB_PASSWORD') ?: 'cE8pCJJ3zUIRViynRXwIUVx8vLjgrcmj';
                }

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$conexion = new PDO($dsn, $user, $password);
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
