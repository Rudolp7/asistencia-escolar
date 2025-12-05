<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Administrador") {
    header("Location: ../index.php");
    exit;
}

// Obtener lista de tutores
$query = "SELECT * FROM tutores";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tutores</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:30px;
        }
        .table-box{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.15);
        }
        .btn-add{
            font-size:18px;
            margin-bottom:20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2 class="mb-4 text-center">👨‍👧 Lista de Tutores</h2>

    <!-- Botón agregar -->
    <div class="text-end mb-3">
        <a href="tutor_nuevo.php" class="btn btn-primary btn-add">
            ➕ Agregar Tutor
        </a>
    </div>

    <!-- Tabla -->
    <div class="table-box">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($t = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $t['id_tutor'] ?></td>
                    <td><?= htmlspecialchars($t['nombre']) ?></td>
                    <td><?= htmlspecialchars($t['telefono']) ?></td>
                    <td><?= htmlspecialchars($t['email']) ?></td>

                    <td>
                        <a href="tutor_editar.php?id=<?= $t['id_tutor'] ?>" class="btn btn-sm btn-warning">
                            ✏ Editar
                        </a>

                        <a href="tutor_eliminar.php?id=<?= $t['id_tutor'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar este tutor?')">
                            🗑 Eliminar
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Regresar -->
    <div class="text-center mt-4">
        <a href="panel.php" class="btn btn-secondary">
            ⬅ Volver al Panel
        </a>
    </div>

</div>

</body>
</html>
