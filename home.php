<?php
include 'config.php';
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT id, nombre_usuario, creado_en FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Usuarios</h2>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">ID: <?php echo $row["id"]; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Nombre de Usuario</h6>
                                <p class="card-text"><?php echo $row["nombre_usuario"]; ?></p>
                                <h6 class="card-subtitle mb-2 text-muted">Fecha de Registro</h6>
                                <p class="card-text"><?php echo $row["creado_en"]; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No se encontraron usuarios.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
