<?php
session_start();

if (!isset($_SESSION['nombreUsuario']) || !isset($_SESSION['usuarioID'])) {
    echo '<script>
        alert("Debe iniciar sesión para acceder a esta página.");
        window.location.href = "login.php";
    </script>';
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no proporcionado.";
    exit;
}

// Obtener la tarea actual
$stmt = $mysqli->prepare("SELECT * FROM tareaUsuario WHERE id = ? AND usuarioID = ?");
$stmt->bind_param("ii", $id, $_SESSION['usuarioID']);
$stmt->execute();
$tarea = $stmt->get_result()->fetch_assoc();

if (!$tarea) {
    echo "Tarea no encontrada o no pertenece al usuario.";
    cerrarConexion($mysqli);
    exit;
}

// Actualizar tarea si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $mysqli->prepare("UPDATE tareaUsuario 
                                  SET tarea = ?, nombre = ?, descripcion = ?, estadoID = ?, fechaActualizacion = NOW(), urlImagen = ?
                                  WHERE id = ? AND usuarioID = ?");
        $stmt->bind_param(
            "sssissi", 
            $_POST["tarea"], 
            $_POST["nombre"], 
            $_POST["descripcion"], 
            $_POST["estadoID"], 
            $_POST["urlImagen"],
            $id,
            $_SESSION['usuarioID']
        );

        if ($stmt->execute()) {
            cerrarConexion($mysqli);
            echo '<script>window.location.href = "listaTareas.php"</script>';

            exit;
        } else {
            throw new Exception("Error al actualizar la tarea.");
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../componentes/navbar.php'; ?>

<div class="container mt-4">
    <h2>Editar Tarea</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="tarea" class="form-label">Título</label>
            <input type="text" class="form-control" name="tarea" id="tarea" value="<?= htmlspecialchars($tarea['tarea']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Interno</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($tarea['nombre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="estadoID" class="form-label">Estado</label>
            <select name="estadoID" id="estadoID" class="form-select" required>
                <option value="1" <?= $tarea['estadoID'] == 1 ? 'selected' : '' ?>>Pendiente</option>
                <option value="2" <?= $tarea['estadoID'] == 2 ? 'selected' : '' ?>>En progreso</option>
                <option value="3" <?= $tarea['estadoID'] == 3 ? 'selected' : '' ?>>Completada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="urlImagen" class="form-label">URL de Imagen</label>
            <input type="url" class="form-control" name="urlImagen" id="urlImagen" value="<?= htmlspecialchars($tarea['urlImagen']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="listaTareas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
