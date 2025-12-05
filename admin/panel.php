<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Administrador") {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Administrador</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body{ background:#f4f6f9; }
    .card-option{
        padding:25px;
        text-align:center;
        border-radius:12px;
        font-size:18px;
        color:white;
        cursor:pointer;
        text-decoration:none;
        display:block;
    }
</style>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Panel del Administrador</h2>

    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="alumnos.php" class="card-option" style="background:#0275d8;">
                📘 Gestión de Alumnos
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="tutores.php" class="card-option" style="background:#5cb85c;">
                👨‍👧 Gestión de Tutores
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="grupos.php" class="card-option" style="background:#f0ad4e;">
                🏫 Gestión de Grupos
            </a>
        </div>
    </div>

    <hr>

    <a href="../logout.php" class="btn btn-danger">Cerrar Sesión</a>
</div>

</body>
</html>
