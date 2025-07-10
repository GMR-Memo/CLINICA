<?php
class ConexionHost {
    private static $conexion = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                // Leer desde variables de entorno proporcionadas por Render
                $host = getenv('DB_HOST');
                $port = getenv('DB_PORT') ?: '5432';
                $dbname = getenv('DB_NAME');
                $user = getenv('DB_USER');
                $password = getenv('DB_PASSWORD');

                if (!$host || !$dbname || !$user || !$password) {
                    throw new Exception("Faltan variables de entorno para la conexión a la base de datos.");
                }

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$conexion = new PDO($dsn, $user, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $e) {
                exit('Error de conexión: ' . $e->getMessage());
            } catch (PDOException $e) {
                exit('Error de conexión PDO: ' . $e->getMessage());
            }
        }
        return self::$conexion;
    }

    public static function desconectar() {
        self::$conexion = null;
    }
}
?>
