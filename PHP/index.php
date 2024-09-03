<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
   exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <h1>Bienvenido</h1>

    <?php if ($tipo_usuario == 'admin'): ?>
        <p>Eres un administrador. Puedes realizar cualquier acción.</p>
        <!-- Añadir acciones administrativas -->
    <?php elseif ($tipo_usuario == 'usuario'): ?>
        <p>Eres un cliente. Puedes solicitar una reserva.</p>
        <a href="solicitar_reserva.php">Solicitar Reserva</a>
    <?php elseif ($tipo_usuario == 'empleado'): ?>
        <p>Eres un empleado. Puedes revisar todas las reservas.</p>
        <a href="ver_reservas.php">Ver Reservas</a>
    <?php endif; ?>
    
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
