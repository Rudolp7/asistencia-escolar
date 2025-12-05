<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$alumno = $conn->query("SELECT * FROM alumnos WHERE id_alumno = $id")->fetch_assoc();
$grupos = $conn->query("SELECT * FROM grupos");
$tutores = $conn->query("SELECT * FROM tutores");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $id_grupo = $_POST['id_grupo'];
    $id_tutor = $_POST['id_tutor'];

    $query = "UPDATE alumnos 
              SET nombre='$nombre', matricula='$matricula', id_grupo=$id_grupo, id_tutor=$id_tutor
              WHERE id_alumno = $id";

    if ($conn->query($query)) {
        header("Location: alumnos.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:30px;
        }
        .form-box{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.15);
            max-width:600px;
            margin:auto;
        }
        .title{
            text-align:center;
            margin-bottom:20px;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2 class="title">✏ Editar Alumno</h2>

    <form method="POST">

        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre del Alumno:</label>
            <input type="text" name="nombre" class="form-control" 
                   value="<?= htmlspecialchars($alumno['nombre']) ?>" required>
        </div>

        <!-- Matrícula -->
        <div class="mb-3">
            <label class="form-label">Matrícula:</label>
            <input type="text" name="matricula" class="form-control" 
                   value="<?= htmlspecialchars($alumno['matricula']) ?>" required>
        </div>

        <!-- Grupo -->
        <div class="mb-3">
            <label class="form-label">Grupo:</label>
            <select name="id_grupo" class="form-select" required>
                <?php while ($g = $grupos->fetch_assoc()): ?>
                    <option value="<?= $g['id_grupo'] ?>"
                        <?= ($g['id_grupo'] == $alumno['id_grupo']) ? 'selected' : '' ?>>
                        <?= $g['grado'] . " " . $g['grupo'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Tutor -->
        <div class="mb-3">
            <label class="form-label">Tutor:</label>
            <select name="id_tutor" class="form-select" required>
                <?php while ($t = $tutores->fetch_assoc()): ?>
                    <option value="<?= $t['id_tutor'] ?>"
                        <?= ($t['id_tutor'] == $alumno['id_tutor']) ? 'selected' : '' ?>>
                        <?= $t['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Botón guardar -->
        <button type="submit" class="btn btn-success w-100 mt-3">
            Guardar Cambios
        </button>
    </form>

    <!-- Regresar -->
    <div class="text-center mt-4">
        <a href="alumnos.php" class="btn btn-secondary">
            ⬅ Regresar
        </a>
    </div>

</div>

</body>
</html>
