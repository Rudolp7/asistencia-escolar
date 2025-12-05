<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$tutor = $conn->query("SELECT * FROM tutores WHERE id_tutor = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $query = "UPDATE tutores 
              SET nombre='$nombre', telefono='$telefono', email='$email'
              WHERE id_tutor = $id";

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
    <title>Editar Tutor</title>

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
    <h2>✏ Editar Tutor</h2>

    <form method="POST">

        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control"
                   value="<?= htmlspecialchars($tutor['nombre']) ?>" required>
        </div>

        <!-- Teléfono -->
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" name="telefono" class="form-control"
                   value="<?= htmlspecialchars($tutor['telefono']) ?>" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($tutor['email']) ?>" required>
        </div>

        <!-- Botón guardar -->
        <button type="submit" class="btn btn-warning w-100 mt-3">
            Guardar Cambios
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
