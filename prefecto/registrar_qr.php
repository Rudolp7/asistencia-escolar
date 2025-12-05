<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Prefecto") {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['qr'])) {
    die("No se envió QR.");
}

$qr_value = $_GET['qr'];  // aquí esperamos que venga el id del alumno

// Buscar alumno por QR
$query = "SELECT * FROM alumnos WHERE qr_code = '$qr_value'";
$result = $conn->query($query);

if ($result->num_rows === 0) {
    die("QR no válido o alumno no encontrado.");
}

$alumno = $result->fetch_assoc();
$id_alumno = $alumno['id_alumno'];

// Registrar asistencia
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$prefecto = $_SESSION['id_usuario'];

$query_insert = "INSERT INTO asistencias(id_alumno, fecha, hora_entrada, metodo_registro, registrado_por)
                 VALUES($id_alumno, '$fecha', '$hora', 'QR', $prefecto)";

if ($conn->query($query_insert)) {
    echo "<h1>Asistencia registrada por QR ✔</h1>";
    echo "<p>Alumno: " . $alumno['nombre'] . "</p>";
    echo "<p>Hora: $hora</p>";
    echo '<a href="escanear.php">⬅ Escanear otro</a>';
} else {
    echo "Error: " . $conn->error;
}
?>
