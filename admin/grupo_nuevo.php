<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grado = $_POST['grado'];
    $grupo = $_POST['grupo'];

    $query = "INSERT INTO grupos(grado, grupo) VALUES ('$grado', '$grupo')";

    if ($conn->query($query)) {
        header("Location: grupos.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Grupo</title>

    <!-- BOOTSTRAP -->
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
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            max-width:600px;
            margin:auto;
        }
        h2{
            text-align:center;
            margin-bottom:25px;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2>➕ Agregar Grupo</h2>

    <form method="POST">

        <!-- Grado -->
        <div class="mb-3">
            <label class="form-label">Grado:</label>
            <input type="text" name="grado" class="form-control" required>
        </div>

        <!-- Grupo -->
        <div class="mb-3">
            <label class="form-label">Grupo:</label>
            <input type="text" name="grupo" class="form-control" required>
        </div>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-success w-100 mt-3">
            Guardar Grupo
        </button>
    </form>

    <!-- Regresar -->
    <div class="text-center mt-4">
        <a href="grupos.php" class="btn btn-secondary">
            ⬅ Regresar
        </a>
    </div>
</div>

</body>
</html>
