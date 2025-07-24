<?php
session_start();

if (!isset($_SESSION['nombreUsuario']) || !isset($_SESSION['usuarioID'])) {
    echo '<script>
        alert("Debe iniciar sesión para acceder a esta página.");
        window.location.href = "login.php";
    </script>';
    exit;
}

require_once '../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

$usuarioID = $_SESSION['usuarioID'];

$sql = "SELECT tarea, descripcion, urlImagen 
        FROM tareaUsuario 
        WHERE usuarioID = ?";
        
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<?php include 'componentes/navbar.php'; ?>

<header class="mb-4">
  <div class="p-5 text-center bg-image" style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80'); height: 400px; background-size: cover; background-position: center;">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); height: 100%;">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3 fw-bold display-4">Bienvenido, <?= htmlspecialchars($_SESSION["nombreUsuario"] ?? "Usuario") ?>.</h1>
          <h5 class="mb-4">Gestiona tus tareas de manera eficiente y ordenada.</h5>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="row mt-5 ps-5" id="task-list">
  <?php while ($row = $result->fetch_assoc()) { ?>
    <?php 
      $titulo = $row['tarea'];
      if (strlen($titulo) > 50) {
          $titulo = substr($titulo, 0, 50) . '...';
      }
    ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-lg border-0 rounded-2 overflow-hidden">
        <?php if (!empty($row['urlImagen'])): ?>
          <img src="<?= htmlspecialchars($row['urlImagen']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Imagen de la tarea">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title fw-bold"><?= htmlspecialchars($titulo) ?></h5>
          <p class="card-text text-secondary"><?= htmlspecialchars($row['descripcion']) ?></p>
        </div>
        <div class="card-footer bg-light text-end">
          <small class="text-muted">Tarea asignada</small>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php include 'componentes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>