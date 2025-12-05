<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Prefecto") {
    header("Location: ../index.php");
    exit;
}

// obtener lista de alumnos
$query = "SELECT a.id_alumno, a.nombre, a.matricula, g.grupo, g.grado 
          FROM alumnos a
          LEFT JOIN grupos g ON a.id_grupo = g.id_grupo
          ORDER BY g.grado, g.grupo, a.nombre";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Manual</title>

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

    <h2 class="text-center mb-4">📝 Registro Manual de Asistencia</h2>
    <p class="text-center mb-4">
        Selecciona un alumno que olvidó su QR.
    </p>

    <div class="table-box">

        <table class="table table-striped table-hover text-center">
            <thead class="table-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Matrícula</th>
                    <th>Grupo</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['matricula']) ?></td>
                    <td><?= htmlspecialchars($row['grado'] . " " . $row['grupo']) ?></td>
                    <td>
                        <a href="registrar_manual_guardar.php?id=<?= $row['id_alumno'] ?>"
                           class="btn btn-success btn-sm">
                           Registrar entrada
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

    </div>

    <div class="text-center mt-4">
        <a href="panel_prefecto.php" class="btn btn-secondary">
            ⬅ Volver al Panel del Prefecto
        </a>
    </div>

</div>

</body>
</html>
