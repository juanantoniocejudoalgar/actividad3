<?php
session_start();

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT id, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hash_contrasena);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($contrasena, $hash_contrasena)) {
        $_SESSION["usuario_id"] = $id;
        header("Location: home.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Nombre de usuario o contraseña incorrectos</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form action="login.php" method="post" class="p-4 border rounded bg-white shadow-sm">
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
        <div class="text-center mt-3">
            <p>¿No tienes una cuenta? <a href="register.php" class="link-primary">Registrarse</a></p>
        </div>
    </div>
</body>
</html>
