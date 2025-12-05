<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$conn->query("DELETE FROM alumnos WHERE id_alumno = $id");

header("Location: alumnos.php");
exit;
