<?php
include 'conexion.php';
session_start();

// Verificar si el usuario es cliente
if ($_SESSION['tipo_usuario'] != 'cliente') {
    header("Location: index.php");
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $motivo = htmlspecialchars($_POST['motivo']);

    // Preparar la consulta
    $consulta = $conn->prepare("INSERT INTO reserva (idUsuario, fechaReserva, motivo) VALUES (?, ?, ?)");

    if ($consulta === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular parámetros y ejecutar la consulta
    $consulta->bind_param("iss", $id_usuario, $fecha_reserva, $motivo);

    if ($consulta->execute()) {
        // Establecer un mensaje de éxito en la sesión
        $_SESSION['mensaje_exito'] = "Reserva solicitada con éxito.";

        // Obtener los detalles del usuario para la notificación
        $usuario_query = $conn->prepare("SELECT nombre, apellido, correoElectronico FROM usuario WHERE id = ?");
        $usuario_query->bind_param("i", $id_usuario);
        $usuario_query->execute();
        $usuario_result = $usuario_query->get_result();
        $usuario = $usuario_result->fetch_assoc();

        // Enviar notificación por correo electrónico
        $to = $usuario['correoElectronico'];
        $subject = "Confirmación de Reserva";
        $message = "Hola " . htmlspecialchars($usuario['nombre']) . " " . htmlspecialchars($usuario['apellido']) . ",\n\n";
        $message .= "Tu reserva ha sido solicitada con éxito.\n\n";
        $message .= "Detalles de la reserva:\n";
        $message .= "Fecha de Reserva: " . htmlspecialchars($fecha_reserva) . "\n";
        $message .= "Motivo: " . htmlspecialchars($motivo) . "\n\n";
        $message .= "Gracias,\nEl equipo de reservas";
        $headers = "From: no-reply@sistemareserva.com";

        if (mail($to, $subject, $message, $headers)) {
            // Redirigir a la página principal
            header("Location: index.php");
            exit();
        } else {
            echo "Error al enviar la notificación por correo electrónico.";
            header("Location: index.php");
            exit();
        }

        // Cerrar la consulta de usuario
        $usuario_query->close();
    } else {
        echo "Error: " . $consulta->error;
    }

    // Cerrar la consulta
    $consulta->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Reserva</title>
    <link rel="stylesheet" href="solicitar_reserva.css">
</head>
<body>
    <div class="container">
        <h1>Solicitar Reserva</h1>
        <form method="post">
            <label for="fecha_reserva">Fecha de la Reserva:</label><br>
            <input type="date" id="fecha_reserva" name="fecha_reserva" required><br><br>

            <label for="motivo">Motivo de la Reserva:</label><br>
            <textarea id="motivo" name="motivo" required></textarea><br><br>

            <input type="submit" value="Solicitar Reserva">
        </form>
    </div>
</body>
</html>
