<?php
session_start();
// echo $_SESSION["nombreUsuario"];

if(!isset($_SESSION["nombreUsuario"])){
    echo '<script> 
        alert("Debe iniciar sesión para acceder a esta página.") 
        window.location.href = "login.php"
        </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="../scripts/dashboard.js"></script>
    <title>Dashboard</title>
</head>

<body>

<?php include 'componentes/navbar.php' ?>

<header class="mb-4">
  <div class="p-5 text-center bg-image" style="
    background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
    height: 400px;
    background-size: cover;
    background-position: center;
  ">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); height: 100%;">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3 fw-bold display-4">Bienvenido, <?php echo $_SESSION["nombreUsuario"] ?> .</h1>
          <h5 class="mb-4">Gestiona tus tareas de manera eficiente y ordenada.</h5>
        </div>
      </div>
    </div>
  </div>
</header>

    <div data-aos="flip-up" class="row mt-5 pl-5" id="task-list">
        <!-- Mostrar los cards -->

    </div>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
  AOS.init();
</script>

</body>

</html>