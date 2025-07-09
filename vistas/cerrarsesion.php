<?php
// logout.php
session_start();
session_unset();      // Limpia todas las variables de sesión
session_destroy();    // Destruye la sesión

// Redireccionar al login o portada
header("Location: login.php");
exit;
