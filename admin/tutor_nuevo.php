<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $query = "INSERT INTO tutores(nombre, telefono, email)
              VALUES ('$nombre', '$telefono', '$email')";

    if ($conn->query($query)) {
        header("Location: tutores.php");
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
    <title>Agregar Tutor</title>

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
    <h2>➕ Agregar Tutor</h2>

    <form method="POST">

        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre del Tutor:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <!-- Teléfono -->
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Botón guardar -->
        <button type="submit" class="btn btn-success w-100 mt-3">
            Guardar Tutor
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="tutores.php" class="btn btn-secondary">
            ⬅ Regresar
        </a>
    </div>
</div>

</body>
</html>
