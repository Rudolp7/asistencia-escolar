<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body{
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#eaf1fb;
        }
        .login-card{
            width:380px;
            padding:25px;
            background:white;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.15);
        }
        h3{
            text-align:center;
            margin-bottom:20px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3>Iniciar Sesión</h3>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Entrar</button>
    </form>
</div>

</body>
</html>
