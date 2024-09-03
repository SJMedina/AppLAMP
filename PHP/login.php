<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    try {
        $usuario = verificarLogin($conn, $username, $passwd);

        // Si se logra la autenticación, se establecen las variables de sesión
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        header("Location: index.php");
        exit();

    } catch (Exception $e) {
        // Capturar la excepción y mostrar un mensaje de error al usuario
        $error = "Error de autenticación: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form method="post">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" id="nombre_usuario" name="username" required>

            <label for="contrasenia">Contraseña:</label>
            <input type="password" id="contrasenia" name="passwd" required>

            <input type="submit" value="Iniciar Sesión">
        </form>

        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>
