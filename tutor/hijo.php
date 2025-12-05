<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Tutor") {
    header("Location: ../index.php");
    exit;
}

$id_tutor  = $_SESSION['id_tutor'] ?? null;
$id_alumno = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id_tutor || !$id_alumno) {
    die("Datos incompletos.");
}

// Verificar que el alumno pertenezca a este tutor
$queryAlumno = "SELECT a.*, g.grado, g.grupo
                FROM alumnos a
                LEFT JOIN grupos g ON a.id_grupo = g.id_grupo
                WHERE a.id_alumno = $id_alumno
                  AND a.id_tutor = $id_tutor
                LIMIT 1";

$resultAlumno = $conn->query($queryAlumno);

if ($resultAlumno->num_rows === 0) {
    die("No tienes permisos para ver este alumno.");
}

$alumno = $resultAlumno->fetch_assoc();

// Asistencia de hoy
$hoy = date("Y-m-d");
$queryHoy = "SELECT * FROM asistencias
             WHERE id_alumno = $id_alumno AND fecha = '$hoy'";
$asistenciaHoy = $conn->query($queryHoy)->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Alumno</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:30px;
        }
        .card-box{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            max-width:650px;
            margin:auto;
        }
    </style>
</head>

<body>

<div class="card-box">
    <h2 class="text-center mb-4">👦 Información del Alumno</h2>

    <h4><?= htmlspecialchars($alumno['nombre']) ?></h4>
    <p><b>Matrícula:</b> <?= htmlspecialchars($alumno['matricula']) ?></p>
    <p><b>Grupo:</b> <?= htmlspecialchars($alumno['grado'] . " " . $alumno['grupo']) ?></p>

    <!-- Estado de asistencia -->
    <?php if ($asistenciaHoy): ?>
        <div class="alert alert-success mt-3">
            ✔ El alumno asistió HOY
        </div>
    <?php else: ?>
        <div class="alert alert-danger mt-3">
            ❌ El alumno NO ha registrado asistencia hoy
        </div>
    <?php endif; ?>

    <div class="mt-4 text-center">
        <a href="historial.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-primary w-100 mb-2">
            📅 Ver Historial Completo
        </a>

        <a href="panel_tutor.php" class="btn btn-secondary w-100">
            ⬅ Volver al Panel del Tutor
        </a>
    </div>
</div>

</body>
</html>
