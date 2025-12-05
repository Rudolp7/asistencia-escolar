<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Tutor") {
    header("Location: ../index.php");
    exit;
}

$id_tutor = $_SESSION['id_tutor'] ?? null;

if (!$id_tutor) {
    die("No se encontró el tutor asociado a este usuario.");
}

// Datos del tutor
$tutor = $conn->query("SELECT * FROM tutores WHERE id_tutor = $id_tutor")->fetch_assoc();

// Hijos asignados
$queryHijos = "SELECT a.id_alumno, a.nombre, a.matricula, g.grado, g.grupo
               FROM alumnos a
               LEFT JOIN grupos g ON a.id_grupo = g.id_grupo
               WHERE a.id_tutor = $id_tutor";
$hijos = $conn->query($queryHijos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel del Tutor</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        background:#f4f6f9;
        padding:30px;
    }
    .panel-box{
        background:white;
        padding:35px;
        border-radius:15px;
        box-shadow:0 0 10px rgba(0,0,0,0.15);
        max-width:800px;
        margin:auto;
    }
    table{
        background:white;
        border-radius:10px;
        overflow:hidden;
    }
</style>

</head>
<body>

<div class="panel-box">
    <h2 class="text-center mb-4">Panel del Tutor</h2>

    <h4 class="mb-3">Bienvenido(a), <?= htmlspecialchars($tutor['nombre']) ?></h4>
    <h5 class="text-muted">Hijos Asignados</h5>
    <hr>

    <?php if ($hijos->num_rows === 0): ?>

        <p class="text-danger">No hay alumnos asignados a este tutor.</p>

    <?php else: ?>

        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Matrícula</th>
                    <th>Grupo</th>
                    <th>Detalles</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($h = $hijos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($h['nombre']) ?></td>
                    <td><?= htmlspecialchars($h['matricula']) ?></td>
                    <td><?= htmlspecialchars($h['grado'] . " " . $h['grupo']) ?></td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm"
                           href="hijo.php?id=<?= $h['id_alumno'] ?>">
                           👁 Ver info
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <hr>

    <a href="../logout.php" class="btn btn-danger w-100 mt-2">
        🔒 Cerrar sesión
    </a>
</div>

</body>
</html>
