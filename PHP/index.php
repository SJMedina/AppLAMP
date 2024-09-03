<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Verificar si 'tipo_usuario' está definido en la sesión
if (isset($_SESSION['tipo_usuario'])) {
    $tipo_usuario = $_SESSION['tipo_usuario'];
} else {
    // Manejo del error cuando 'tipo_usuario' no está definido
    $tipo_usuario = null; // O puedes establecer un valor predeterminado o redirigir al usuario
    $error = "Error: Tipo de usuario no definido. Por favor, inicie sesión nuevamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Bienvenido</h1>

    <?php
    // Mostrar el mensaje de éxito si existe
    if (isset($_SESSION['mensaje_exito'])) {
        echo "<p class='mensaje-exito'>" . $_SESSION['mensaje_exito'] . "</p>";
        unset($_SESSION['mensaje_exito']);
    }

    // Mostrar el mensaje de error si existe
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <?php if ($tipo_usuario == 'admin'): ?>
        <p>Eres un administrador. Puedes realizar cualquier acción.</p>
    <?php elseif ($tipo_usuario == 'cliente'): ?>
        <p>Eres un cliente. Puedes solicitar una reserva.</p>
        <a href="solicitar_reserva.php">Solicitar Reserva</a>
    <?php elseif ($tipo_usuario == 'empleado'): ?>
        <p>Eres un empleado. Puedes revisar todas las reservas.</p>
        <a href="ver_reservas.php">Ver Reservas</a>
    <?php else: ?>
        <p>No se ha podido determinar el tipo de usuario. Por favor, inicie sesión nuevamente.</p>
    <?php endif; ?>
    
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
