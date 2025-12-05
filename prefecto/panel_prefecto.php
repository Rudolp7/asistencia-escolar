<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Prefecto") {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel del Prefecto</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { 
        background:#f4f6f9; 
        padding:30px;
    }

    .panel-box{
        background:white;
        padding:35px;
        border-radius:15px;
        box-shadow:0 0 10px rgba(0,0,0,0.15);
        max-width:500px;
        margin:auto;
    }

    .btn-option{
        width:100%;
        padding:15px;
        font-size:18px;
        border-radius:10px;
        margin-bottom:15px;
    }
</style>

</head>
<body>

<div class="panel-box text-center">
    <h2 class="mb-4">Panel del Prefecto</h2>

    <a href="escanear.php" class="btn btn-primary btn-option">
        📷 Escanear QR
    </a>

    <a href="registrar_manual.php" class="btn btn-success btn-option">
        📝 Registrar Manual
    </a>

    <a href="../logout.php" class="btn btn-danger btn-option">
        🔒 Cerrar sesión
    </a>
</div>

</body>
</html>
