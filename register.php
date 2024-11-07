<?php
include 'config.php';

// Conectar a la base de datos
$servername = "db";
$username = "userAdmin";
$password = "userPassword";
$dbname = "mi_aplicacion";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta de inserción
$sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Obtener datos del formulario y vincularlos a la consulta
$username = (isset($_POST['nombre_usuario'])!=null)? $_POST['nombre_usuario']:"";
$password = (isset($_POST['contrasena'])!=null)?password_hash($_POST['contrasena'], PASSWORD_BCRYPT):"";

$stmt->bind_param("ss", $username, $password);  // Vincula los parámetros

// Ejecutar la consulta
if($username!="" && $password!=""){
if ($stmt->execute()) {
    echo "Usuario registrado correctamente";
    echo "<script>window.location.href='login.php'</script>";

} else {
    echo "Error al registrar usuario: " . $stmt->error;
}}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Registro de Usuario</h2>
        <form action="register.php" method="post" class="p-4 border rounded bg-white shadow-sm">
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
        <div class="text-center mt-3">
            <p>¿Ya tienes una cuenta? <a href="login.php" class="link-primary">Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>
