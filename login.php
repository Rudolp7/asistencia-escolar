<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$usuario  = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$usuario  = trim($usuario);
$password = trim($password);

$query = "SELECT * FROM usuarios_sistema WHERE usuario='$usuario' LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Aquí estamos usando contraseña en texto plano (para el proyecto está bien)
    if ($password === $user['password']) {

        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['rol']        = $user['rol'];

        // si el usuario tiene id_tutor (para el rol Tutor)
        if (isset($user['id_tutor'])) {
            $_SESSION['id_tutor'] = $user['id_tutor'];
        }

        if ($user['rol'] === "Administrador") {
            header("Location: admin/panel.php");
            exit;
        } elseif ($user['rol'] === "Prefecto") {
            header("Location: prefecto/panel_prefecto.php");
            exit;
        } elseif ($user['rol'] === "Tutor") {
            header("Location: tutor/panel_tutor.php");
            exit;
        } else {
            echo "Rol no reconocido";
        }
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>
