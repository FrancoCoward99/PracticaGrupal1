<?php
session_start();

require_once '../../accesoDatos/accesoDatos.php';

if (!isset($_SESSION['nombreUsuario'])) {
    header("Location: ../login.php");
    exit;
}

$idTarea = $_GET['id'] ?? null;

if (!$idTarea) {
    echo '<script>alert("ID de tarea no válido."); window.location.href = "listaTareas.php";</script>';
    exit;
}

$mysqli = abrirConexion();

// Validar que la tarea le pertenece al usuario activo
$stmt = $mysqli->prepare("SELECT tu.id FROM tareaUsuario tu 
    JOIN usuarios u ON tu.usuarioID = u.id 
    WHERE tu.id = ? AND u.nombreUsuario = ?");
$stmt->bind_param("is", $idTarea, $_SESSION['nombreUsuario']);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo '<script>alert("No tiene permiso para eliminar esta tarea."); window.location.href = "listaTareas.php";</script>';
    exit;
}

// Eliminar
$delete = $mysqli->prepare("DELETE FROM tareaUsuario WHERE id = ?");
$delete->bind_param("i", $idTarea);
$delete->execute();

cerrarConexion($mysqli);

echo '<script>alert("Tarea eliminada correctamente."); window.location.href = "listaTareas.php";</script>';
?>
