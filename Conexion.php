<?php
class Conexion {
    private static $conexion = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$conexion === null) {
            try {
<<<<<<< HEAD
                $host = 'dpg-d1napbqdbo4c73fvjt0g-a.oregon-postgres.render.com';
                $port = '5433';
                $dbname = 'ClinicaSalud';
                $user = 'postgres';
                $password = 'cE8pCJJ3zUIRViynRXwIUVx8vLjgrcmj';
=======
                // Leer desde variables de entorno proporcionadas por Render
                $host = getenv('DB_HOST');
                $port = getenv('DB_PORT') ?: '5432';
                $dbname = getenv('DB_NAME');
                $user = getenv('DB_USER');
                $password = getenv('DB_PASSWORD');

                if (!$host || !$dbname || !$user || !$password) {
                    throw new Exception("Faltan variables de entorno para la conexión a la base de datos.");
                }
>>>>>>> 00072a2f85ad2a053680745659a8a0714af4b67a

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$conexion = new PDO($dsn, $user, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
            } catch (PDOException $e) {
                exit(' Error al conectar con la base de datos: ' . $e->getMessage());
=======

            } catch (Exception $e) {
                exit('Error de conexión: ' . $e->getMessage());
            } catch (PDOException $e) {
                exit('Error de conexión PDO: ' . $e->getMessage());
>>>>>>> 00072a2f85ad2a053680745659a8a0714af4b67a
            }
        }
        return self::$conexion;
    }

    public static function desconectar() {
        self::$conexion = null;
    }
}
?>
