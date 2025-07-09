<?php
// Archivo: test_conexion.php

try {
    $host     = 'localhost';
    $puerto   = '5433';
    $db       = 'clinica_salud';
    $usuario  = 'postgres';
    $password = 'root1234';

    $dsn = "pgsql:host=$host;port=$puerto;dbname=$db";
    $conexion = new PDO($dsn, $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2 style='color: green;'>✅ Conexión exitosa a PostgreSQL</h2>";
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Error de conexión:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
