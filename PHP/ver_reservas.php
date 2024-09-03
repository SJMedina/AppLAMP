<?php
include 'conexion.php';
session_start();

// Verificar si el usuario es empleado
if ($_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: index.php");
    exit();
}

// Inicializar variables de filtro
$fecha_reserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : '';
$nombre_apellido = isset($_POST['nombre_apellido']) ? $_POST['nombre_apellido'] : '';

// Preparar la consulta con filtros
$sql = "SELECT r.nroReserva, u.nombre, u.apellido, r.fechaReserva, r.motivo
        FROM reserva r
        JOIN usuario u ON r.idUsuario = u.id
        WHERE 1=1";

if (!empty($fecha_reserva)) {
    $sql .= " AND r.fechaReserva = ?";
}

if (!empty($nombre_apellido)) {
    $sql .= " AND (u.nombre LIKE ? OR u.apellido LIKE ?)";
}

$consulta = $conn->prepare($sql);

if ($consulta === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Vincular parámetros si hay filtros
$params = [];
$types = '';

if (!empty($fecha_reserva)) {
    $params[] = $fecha_reserva;
    $types .= 's';  // Tipo de dato string
}

if (!empty($nombre_apellido)) {
    $params[] = "%$nombre_apellido%";
    $params[] = "%$nombre_apellido%";
    $types .= 'ss';  // Tipo de dato string para dos parámetros
}

if (!empty($params)) {
    $consulta->bind_param($types, ...$params);
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
    <link rel="stylesheet" href="ver_reservas.css">
</head>
<body>
    <div class="container">
        <h1>Ver Reservas</h1>
        <form method="post">
            <label for="fecha_reserva">Fecha de Reserva:</label>
            <input type="date" id="fecha_reserva" name="fecha_reserva" value="<?php echo htmlspecialchars($fecha_reserva); ?>"><br><br>
            
            <label for="nombre_apellido">Apellido:</label>
            <input type="text" id="nombre_apellido" name="nombre_apellido" value="<?php echo htmlspecialchars($nombre_apellido); ?>"><br><br>
            
            <input type="submit" value="Filtrar">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Número de Reserva</th>
                    <th>Nombre y Apellido</th>
                    <th>Fecha Reserva</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultados->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['nroReserva']); ?></td>
                        <td><?php echo htmlspecialchars($fila['nombre']) . " " . htmlspecialchars($fila['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fechaReserva']); ?></td>
                        <td><?php echo htmlspecialchars($fila['motivo']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Cerrar la consulta y la conexión
$consulta->close();
$conn->close();
?>
