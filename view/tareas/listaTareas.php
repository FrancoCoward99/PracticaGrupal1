<?php
session_start();

if (!isset($_SESSION['nombreUsuario']) || !isset($_SESSION['usuarioID'])) {
    echo '<script>
        alert("Debe iniciar sesión para acceder a esta página.");
        window.location.href = "login.php";
    </script>';
    exit;
}

require_once '../../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

$usuarioID = $_SESSION['usuarioID'];

$sql = "SELECT id, tarea, nombre, descripcion, estadoID, fechaCreacion, fechaActualizacion, urlImagen 
        FROM tareaUsuario 
        WHERE usuarioID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$result = $stmt->get_result();

function estadoNombre($id) {
    switch ($id) {
        case 1: return "Pendiente";
        case 2: return "En progreso";
        case 3: return "Completada";
        default: return "Desconocido";
    }
}

function estadoBadge($id) {
    switch ($id) {
        case 1: return '<span class="badge bg-secondary">Pendiente</span>';
        case 2: return '<span class="badge bg-warning text-dark">En progreso</span>';
        case 3: return '<span class="badge bg-success">Completada</span>';
        default: return '<span class="badge bg-dark">Desconocido</span>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../componentes/navbar.php'; ?>

    <div class="container mt-5 flex-grow-1">
        <h1 class="mb-4">Mis Tareas</h1>
        <a href="nuevaTarea.php" class="btn btn-success mb-4">Nueva Tarea</a>

        <div class="row">
            <?php while ($tarea = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($tarea['urlImagen'])): ?>
                            <img src="<?= htmlspecialchars($tarea['urlImagen']) ?>" class="card-img-top" alt="Imagen de tarea" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($tarea['tarea']) ?></h5>
                            <p class="fw-bold text-secondary mb-1"><?= htmlspecialchars($tarea['nombre']) ?></p>
                            <p class="card-text"><?= htmlspecialchars($tarea['descripcion']) ?></p>
                            <p class="text-muted mb-1 fw-bold">Estado: <?= estadoBadge($tarea['estadoID']) ?></p>

                            <p class="text-muted mb-1 fw-bold">
                                Creado: <?= htmlspecialchars($tarea['fechaCreacion']) ?>
                            </p>
                            <p class="text-muted fw-bold">
                                Actualizado: <?= htmlspecialchars($tarea['fechaActualizacion']) ?>
                            </p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="editarTarea.php?id=<?= $tarea['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="eliminarTarea.php?id=<?= $tarea['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
