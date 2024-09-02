<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "";
$password = "";
$dbname = "DBReservaTurnos";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para verificar el inicio de sesión con manejo de errores
function verificarLogin($conn, $nombre_usuario, $contrasenia) {
    try {
        $consulta = $conn->prepare("SELECT id, tipo_usuario FROM usuario WHERE username = ? AND contrasenia = ?");
        if (!$consulta) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        $consulta->bind_param("ss", $nombre_usuario, $contrasenia);
        $consulta->execute();
        $consulta->store_result();

        if ($consulta->num_rows == 0) {
            throw new Exception("Nombre de usuario o contraseña incorrectos.");
        }

        $id_usuario = null;
        $tipo_usuario = null;

        $consulta->bind_result($id_usuario, $tipo_usuario);
        $consulta->fetch();
        return ['id_usuario' => $id_usuario, 'tipo_usuario' => $tipo_usuario];

    } catch (Exception $e) {
        // Registrar el error
        error_log($e->getMessage(), 0);
        // Re-lanzar la excepción para manejarla en otro lugar
        throw $e;
    }
}
?>

