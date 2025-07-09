<?php
session_start();
require_once __DIR__ . '/../datos/DAOdoctores.php';

$dao = new DoctorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $dao->eliminar($id);
    $_SESSION['msg'] = "success--Doctor eliminada correctamente.";
} else {
    $_SESSION['msg'] = "danger--ID inválido.";
}

header('Location: ListaDoctores.php');
