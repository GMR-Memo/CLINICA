<?php
session_start();
require_once __DIR__ . '/../datos/DAOpacientes.php';

$dao = new PacienteDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        if ($dao->eliminar($id)) {
            $_SESSION['msg'] = 'alert-success--Paciente eliminado correctamente';
        } else {
            $_SESSION['msg'] = 'alert-danger--Error al eliminar el paciente';
        }
    } else {
        $_SESSION['msg'] = 'alert-warning--ID inválido';
    }
}

header('Location: ListaPacientesDoc.php');
exit;
