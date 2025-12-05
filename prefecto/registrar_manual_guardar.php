<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Prefecto") {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("No se recibió el ID del alumno.");
}

$id_alumno = $_GET['id'];
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$prefecto = $_SESSION['id_usuario'];

// Registrar asistencia manual
$query = "INSERT INTO asistencias(id_alumno, fecha, hora_entrada, metodo_registro, registrado_por)
          VALUES($id_alumno, '$fecha', '$hora', 'Manual', $prefecto)";

$exito = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia Registrada</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:40px;
        }
        .box{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            max-width:500px;
            margin:auto;
            text-align:center;
        }
    </style>
</head>

<body>

<div class="box">

    <?php if ($exito): ?>
        <h2 class="text-success mb-3">✔ Asistencia Registrada</h2>

        <p><b>Alumno ID:</b> <?= $id_alumno ?></p>
        <p><b>Fecha:</b> <?= $fecha ?></p>
        <p><b>Hora:</b> <?= $hora ?></p>
        <p><b>Método:</b> Manual</p>

        <div class="alert alert-success mt-3">
            La asistencia fue guardada correctamente.
        </div>

        <a href="registrar_manual.php" class="btn btn-primary w-100 mt-3">
            Registrar otro alumno
        </a>

        <a href="panel_prefecto.php" class="btn btn-secondary w-100 mt-3">
            ⬅ Volver al Panel del Prefecto
        </a>

    <?php else: ?>

        <h2 class="text-danger">❌ Error al registrar</h2>
        <p><?= $conn->error ?></p>

        <a href="registrar_manual.php" class="btn btn-secondary w-100 mt-3">
            ⬅ Intentar de nuevo
        </a>

    <?php endif; ?>

</div>

</body>
</html>
