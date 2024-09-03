<?php
include 'conexion.php';
session_start();

// Verificar si el usuario es empleado
if ($_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: index.php");
    exit();
}

// Preparar y ejecutar la consulta
$consulta = $conn->prepare("SELECT r.nroReserva, u.nombre, u.apellido, r.fechaReserva, r.motivo
                            FROM reserva r
                            JOIN usuario u ON r.idUsuario = u.id");

if ($consulta === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$resultado = $consulta->execute();

if ($resultado === false) {
    die("Error al ejecutar la consulta: " . $consulta->error);
}

// Obtener los resultados
$resultados = $consulta->get_result();

if ($resultados === false) {
    die("Error al obtener los resultados: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reservas</title>
</head>
<body>
    <h1>Ver Reservas</h1>
    <table border="1">
        <tr>
            <th>Número de Reserva</th>
            <th>Nombre y Apellido</th>
            <th>Fecha Reserva</th>
            <th>Motivo</th>
        </tr>
        <?php while ($fila = $resultados->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($fila['nroReserva']); ?></td>
                <td><?php echo htmlspecialchars($fila['nombre']) . " " . htmlspecialchars($fila['apellido']); ?></td>
                <td><?php echo htmlspecialchars($fila['fechaReserva']); ?></td>
                <td><?php echo htmlspecialchars($fila['motivo']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
// Cerrar la consulta y la conexión
$consulta->close();
$conn->close();
?>
