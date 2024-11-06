<?php
// config.php
$servername = "db";
$username = "userAdmin";
$password = "userPassword";
$dbname = "mi_aplicacion";
//$conn = new mysqli($servername, $username, $password, $dbname);

$max_tries = 5;
while ($max_tries > 0) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $max_tries--;
        sleep(5);  // Espera 5 segundos antes de reintentar
    } else {
        break;  // Si la conexión fue exitosa, rompe el bucle
    }
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
