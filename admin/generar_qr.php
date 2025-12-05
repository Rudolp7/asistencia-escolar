<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../conexion.php';
require_once 'qr_lib/qrlib.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Administrador") {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

// Obtener alumno
$query = "SELECT * FROM alumnos WHERE id_alumno = $id";
$alumno = $conn->query($query)->fetch_assoc();

if (!$alumno) {
    die("Alumno no encontrado");
}

// Si no tiene QR asignado, generamos uno nuevo
if (empty($alumno['qr_code'])) {
    $qr_value = $id . "_" . uniqid();
    $conn->query("UPDATE alumnos SET qr_code = '$qr_value' WHERE id_alumno = $id");
} else {
    $qr_value = $alumno['qr_code'];
}

// Ruta de guardado
$filename = "qr_" . $id . ".png";
$filepath = "qr_images/" . $filename;

// Crear carpeta si no existe
if (!file_exists("qr_images")) {
    mkdir("qr_images", 0777, true);
}

// Generar el QR
QRcode::png($qr_value, $filepath);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>QR del Alumno</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:40px;
        }
        .qr-box{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.15);
            max-width:600px;
            margin:auto;
            text-align:center;
        }
        .qr-img{
            border:5px solid #eaeaea;
            padding:10px;
            border-radius:10px;
            background:white;
        }
    </style>
</head>

<body>

<div class="qr-box">
    <h2 class="mb-3">📲 QR del Alumno</h2>
    <h4 class="text-primary"><?= htmlspecialchars($alumno['nombre']) ?></h4>

    <p class="mt-3">Valor que se escanea:</p>
    <div class="alert alert-info">
        <b><?= $qr_value ?></b>
    </div>

    <img src="<?= $filepath ?>" class="qr-img" width="250">

    <div class="mt-4">
        <a href="<?= $filepath ?>" download class="btn btn-success w-100 mb-2">
            ⬇ Descargar QR
        </a>

        <a href="alumnos.php" class="btn btn-secondary w-100">
            ⬅ Volver
        </a>
    </div>
</div>

</body>
</html>
