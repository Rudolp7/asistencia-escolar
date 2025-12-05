<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $id_grupo = $_POST['id_grupo'];
    $id_tutor = $_POST['id_tutor'];

    $query = "INSERT INTO alumnos(nombre, matricula, id_grupo, id_tutor)
              VALUES ('$nombre', '$matricula', $id_grupo, $id_tutor)";

    if ($conn->query($query)) {
        header("Location: alumnos.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$grupos = $conn->query("SELECT * FROM grupos");
$tutores = $conn->query("SELECT * FROM tutores");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Alumno</title>

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
    </style>
</head>

<body>

<div class="form-box">
    <h2 class="text-center mb-4">➕ Agregar Alumno</h2>

    <form method="POST">

        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre del Alumno:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <!-- Matrícula -->
        <div class="mb-3">
            <label class="form-label">Matrícula:</label>
            <input type="text" name="matricula" class="form-control" required>
        </div>

        <!-- Grupo -->
        <div class="mb-3">
            <label class="form-label">Grupo:</label>
            <select name="id_grupo" class="form-select" required>
                <option disabled selected>Selecciona un grupo...</option>
                <?php while ($g = $grupos->fetch_assoc()): ?>
                    <option value="<?= $g['id_grupo'] ?>">
                        <?= $g['grado'] . " " . $g['grupo'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Tutor -->
        <div class="mb-3">
            <label class="form-label">Tutor:</label>
            <select name="id_tutor" class="form-select" required>
                <option disabled selected>Selecciona un tutor...</option>
                <?php while ($t = $tutores->fetch_assoc()): ?>
                    <option value="<?= $t['id_tutor'] ?>"><?= $t['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Botón guardar -->
        <button type="submit" class="btn btn-success w-100 mt-3">Guardar Alumno</button>
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
