<?php
include 'conexion.php';
session_start();

if ($_SESSION['tipo_usuario'] != 'cliente') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $motivo = htmlspecialchars($_POST['motivo']);

    $consulta = $conn->prepare("INSERT INTO reserva (nroReserva, idUsuario, fechaReserva, motivo) VALUES (?, ?, NULL, ?, ?)");
    $consulta->bind_param("iss", $id_usuario, $fecha_reserva, $motivo);

    if ($consulta->execute()) {
        echo "Reserva solicitada con éxito.";
    } else {
        echo "Error: " . $consulta->error;
    }

    $consulta->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Reserva</title>
</head>
<body>
    <h1>Solicitar Reserva</h1>
    <form method="post">
        <label for="fecha_reserva">Fecha de la Reserva:</label><br>
        <input type="date" id="fecha_reserva" name="fecha_reserva" required><br><br>

        <label for="motivo">Motivo de la Reserva:</label><br>
        <textarea id="motivo" name="motivo" required></textarea><br><br>

        <input type="submit" value="Solicitar Reserva">
    </form>
</body>
</html>
