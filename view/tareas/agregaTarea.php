<?php
require_once '../../accesoDatos/accesoDatos.php';
session_start();

$mysqli = abrirConexion();
if (!$mysqli) {
    die("Error de conexión: " . mysqli_connect_error());
}

$estados = $mysqli->query("SELECT id, descripcion FROM estadoTarea");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tarea = $_POST['tarea'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estadoID = $_POST['estadoID'];
    $usuarioID = $_SESSION['usuarioID'];
    $urlImagen = $_POST['urlImagen'] ?? null;

    $sql = "INSERT INTO tareaUsuario (tarea, nombre, descripcion, estadoID, usuarioID, urlImagen) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    
    if (!$stmt) {
        die("Error en prepare: " . $mysqli->error);
    }

    $stmt->bind_param("sssiss", $tarea, $nombre, $descripcion, $estadoID, $usuarioID, $urlImagen);
    $stmt->execute();

    header("Location: listaTareas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../componentes/navbar.php'; ?>

    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow-lg" style="width: 100%; max-width: 750px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Nueva Tarea</h2>
                <form method="POST" action="agregaTarea.php">
                    <div class="mb-3">
                        <label for="tarea" class="form-label fw-semibold">Tarea</label>
                        <input type="text" class="form-control" name="tarea" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Título</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estadoID" class="form-label fw-semibold">Estado</label>
                        <select class="form-select" name="estadoID" required>
                            <option value="">Seleccione el estado de la tarea</option>
                            <?php while ($estado = $estados->fetch_assoc()): ?>
                                <option value="<?= $estado['id'] ?>"><?= htmlspecialchars($estado['descripcion']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="urlImagen" class="form-label fw-semibold">URL de imagen</label>
                        <input type="text" class="form-control" name="urlImagen" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-success fw-semibold">Agregar tarea</button>
                        <a href="listaTareas.php" class="btn btn-secondary ">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>
</body>
</html>

