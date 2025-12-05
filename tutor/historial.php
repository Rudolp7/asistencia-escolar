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

// Verificar que el alumno pertenece al tutor
$queryAlumno = "SELECT a.*, g.grado, g.grupo
                FROM alumnos a
                LEFT JOIN grupos g ON a.id_grupo = g.id_grupo
                WHERE a.id_alumno = $id_alumno
                  AND a.id_tutor = $id_tutor
                LIMIT 1";
$resAlumno = $conn->query($queryAlumno);

if ($resAlumno->num_rows === 0) {
    die("No tienes permisos para ver este alumno.");
}

$alumno = $resAlumno->fetch_assoc();

// Historial
$queryHist = "SELECT * FROM asistencias
              WHERE id_alumno = $id_alumno
              ORDER BY fecha DESC, hora_entrada DESC";
$historial = $conn->query($queryHist);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de asistencia</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:30px;
        }
        .table-box{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

<div class="container">

    <h2 class="mb-2 text-center">📅 Historial de Asistencia</h2>
    <h4 class="text-center text-primary"><?= htmlspecialchars($alumno['nombre']) ?></h4>
    <p class="text-center mb-4"><b>Grupo:</b> <?= htmlspecialchars($alumno['grado'] . " " . $alumno['grupo']) ?></p>

    <div class="table-box">

        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Método</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $historial->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                    <td><?= htmlspecialchars($row['hora_entrada']) ?></td>
                    <td><?= htmlspecialchars($row['metodo_registro']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if ($historial->num_rows === 0): ?>
            <div class="alert alert-info text-center">
                📭 Este alumno aún no tiene asistencias registradas.
            </div>
        <?php endif; ?>

    </div>

    <div class="text-center mt-4">
        <a href="hijo.php?id=<?= $id_alumno ?>" class="btn btn-secondary w-100 mb-2">
            ⬅ Volver al alumno
        </a>
        <a href="panel_tutor.php" class="btn btn-secondary w-100">
            ⬅ Volver al panel del tutor
        </a>
    </div>

</div>

</body>
</html>
