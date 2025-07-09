<?php
session_start();
require_once __DIR__ . '/../datos/DAOcitas.php';

$dao = new CitaDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $completada = (bool)($_POST['completada'] ?? 0);

    if ($id > 0) {
        $dao->marcarAsistencia($id, $completada);
        $_SESSION['msg'] = 'alert-success--Asistencia actualizada.';
    } else {
        $_SESSION['msg'] = 'alert-danger--ID inválido.';
    }
}

header('Location: ListaCitas.php');
