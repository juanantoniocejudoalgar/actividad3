<?php
// config.php
$servername = "localhost";
$username = "userAdmin";
$password = "userPassword";
$dbname = "mi_aplicacion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
