<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Prefecto") {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escanear QR</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Librería del lector QR -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <style>
        body{
            background: #f4f6f9;
            padding: 30px;
        }
        .scanner-box{
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        #reader {
            width: 100%;
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>

<div class="scanner-box">

    <h2 class="mb-3">📷 Escanear QR del Alumno</h2>
    <p class="text-muted">Apunta la cámara hacia el código QR del alumno para registrar asistencia.</p>

    <div id="reader"></div>

    <div class="mt-4">
        <a href="panel_prefecto.php" class="btn btn-secondary w-100">
            ⬅ Volver al Panel del Prefecto
        </a>
    </div>

</div>

<script>
    function onScanSuccess(qrMessage) {
        console.log("QR Detectado:", qrMessage);

        // Redirigir al script que registra la asistencia
        window.location.href = "registrar_qr.php?qr=" + encodeURIComponent(qrMessage);
    }

    function onScanError(errorMessage) {
        // Errores ignorados (el lector sigue intentando)
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: 250 }
    );

    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

</body>
</html>
