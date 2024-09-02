<?php
include 'conexion.php';
session_start();

if ($_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT reserva.* FROM reserva 
        JOIN usuario ON reserva.id_usuario = usuario.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reservas</title>
</head>
<body>
    <h1>Reservas Solicitadas</h1>

    <table border="1">
        <tr>
            <th>ID Reserva</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Reserva</th>
            <th>Motivo</th>
            <th>Fecha de Solicitud</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['apellido']; ?></td>
            <td><?php echo $row['fecha_reserva']; ?></td>
            <td><?php echo $row['motivo']; ?></td>
            <td><?php echo $row['fecha_solicitud']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
