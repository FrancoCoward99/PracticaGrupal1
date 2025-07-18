<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

$resultado = $mysqli->query("SELECT * FROM usuarios ORDER BY fechaRegistro DESC");

// print_r($resultado);

if(!$resultado){
    die("Error en la consulta: " . $mysqli->error);
}

cerrarConexion($mysqli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>

<?php include '../componentes/navbar.php'?>

<div class="container mt-4">

    <h2 class="mb-4">Lista de Usuarios</h2>

    <div class="d-flex mb-3">
        <a href="agregarUsuario.php" class="btn btn-success">Nuevo Usuario</a>
    </div>

    <table class="table table-bordered table-hover align-middle">

        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Usuario</th>
                <th>Género</th>
                <th>Registro</th>
                <th>Actualización</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- <tr>
                <td>1</td>
                <td>Joshua</td>
                <td>Loria</td>
                <td>25</td>
                <td>correo@correo.com</td>
                <td>Masculino</td>
                <td>02-07-2025</td>
                <td>03-07-2025</td>
                <td>
            <a href="" class="btn btn-outline-secondary">Editar</a>  
                <a href="" class="btn btn-outline-secondary">Eliminar</a>    
            </td>
            </tr> -->

            <?php while ($u = $resultado->fetch_assoc()): ?>
                
                <tr>
                     <td> <?php echo $u['id'] ?> </td>
                    <td> <?php echo $u['nombre'] ?> </td>
                    <td> <?php echo $u['apellido1'] ?> </td>
                    <td> <?php echo $u['edad'] ?> </td>
                    <td> <?php echo $u['nombreUsuario'] ?> </td>
                    <td> <?php echo $u['genero'] ?> </td>
                    <td> <?php echo $u['fechaRegistro'] ?> </td>
                    <td> <?php echo $u['fechaActualizacion'] ?> </td>
                    <td> 
                         <a href="editarUsuario.php?id=<?php echo $u['id'] ?>" class="btn btn-outline-secondary">Editar</a>  
                         <a href="eliminarUsuario.php?id=<?php echo $u['id'] ?>" onclick="return confirm('Desea eliminar el usuario?');" class="btn btn-outline-secondary">Eliminar</a>  
                    </td>
                </tr> 

          <?php endwhile;  ?>

        </tbody>

    </table>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inicializar DataTables -->
<script>
  $(document).ready(function() {
    $('table').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
      }
    });
  });
</script>

</body>
</html>