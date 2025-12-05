<?php
session_start();
include '../conexion.php';

$id = $_GET['id'];

$grupo = $conn->query("SELECT * FROM grupos WHERE id_grupo = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $grado = $_POST['grado'];
    $grupoNombre = $_POST['grupo'];

    $query = "UPDATE grupos 
              SET grado='$grado', grupo='$grupoNombre'
              WHERE id_grupo = $id";

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
    <title>Editar Grupo</title>

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
    <h2>✏ Editar Grupo</h2>

    <form method="POST">

        <!-- Grado -->
        <div class="mb-3">
            <label class="form-label">Grado:</label>
            <input type="text" name="grado" class="form-control"
                   value="<?= htmlspecialchars($grupo['grado']) ?>" required>
        </div>

        <!-- Grupo -->
        <div class="mb-3">
            <label class="form-label">Grupo:</label>
            <input type="text" name="grupo" class="form-control"
                   value="<?= htmlspecialchars($grupo['grupo']) ?>" required>
        </div>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-warning w-100 mt-3">
            Guardar Cambios
        </button>

    </form>

    <div class="text-center mt-4">
        <a href="grupos.php" class="btn btn-secondary">
            ⬅ Regresar
        </a>
    </div>
</div>

</body>
</html>
