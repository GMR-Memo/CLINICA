<?php
session_start();
require_once __DIR__ . '/../datos/DAOcitas.php';

$dao = new CitaDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $dao->eliminar($id);
    $_SESSION['msg'] = "success--Cita eliminada correctamente.";
} else {
    $_SESSION['msg'] = "danger--ID inválido.";
}

header('Location: ListaCitas.php');
