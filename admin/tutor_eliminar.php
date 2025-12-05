<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$conn->query("DELETE FROM tutores WHERE id_tutor = $id");

header("Location: tutores.php");
exit;
