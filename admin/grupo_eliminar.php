<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$conn->query("DELETE FROM grupos WHERE id_grupo = $id");

header("Location: grupos.php");
exit;
