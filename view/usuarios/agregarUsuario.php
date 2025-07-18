<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

try{

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, apellido1, apellido2, edad, nombreUsuario, contrasena, fechaRegistro, fechaActualizacion, genero)
    VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");
    $stmt->bind_param("sssisss", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["edad"], $_POST["nombreUsuario"], password_hash($_POST["contrasena"], PASSWORD_DEFAULT), $_POST["genero"]);
    
    if($stmt->execute()){

        cerrarConexion($mysqli);

        echo '<script> 
        alert("El usuario se insertó correctamente.") 
        window.location.href = "listaUsuarios.php"
        </script>';

    }else{
        throw new exception("Sucedió un error al realizar la creación del usuario.");
    }

}

}catch(Exception $e){
    echo '<script> alert("Sucedió un error al insertar al usuario.") </script>';
    echo '<script> console.log(" '.$e->getMessage().' ") </script>';
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
    <title>Crear nuevo usuario</title>
</head>
<body>
    
<?php include '../componentes/navbar.php' ?>

<div class="container mt-4">

<h2>Nuevo usuario</h2>

<form method="POST">

<div class="mb-2">
    <input type="text" name="nombre" id="nombre" class="mb-4 form-control" placeholder="Ingrese su nombre" required>
    <input type="text" name="apellido1" id="apellido1" class="mb-4 form-control" placeholder="Ingrese su primer apellido" required>
    <input type="text" name="apellido2" id="apellido2" class="mb-4 form-control" placeholder="Ingrese su segundo apellido" required>
    <input type="number" name="edad" id="edad" class="mb-4 form-control" placeholder="Ingrese su edad" required>
    <input type="email" name="nombreUsuario" id="nombreUsuario" class="mb-4 form-control" placeholder="Ingrese su correo" required>
    <input type="password" name="contrasena" id="contrasena" class="mb-4 form-control" placeholder="Ingrese su contrasenna" required>

    <select name="genero" id="genero" class="form-select" required>
        <option value="">Seleccione género</option>
    <option value="M">Masculino</option>
        <option value="F">Femenino</option>
        <option value="O">Otro</option>
    </select>
    
</div>

<div class="mt-4">
<button class="btn btn-success" type="submit">Guardar</button>
<a class="btn btn-secondary" href="listaUsuarios.php">Cancelar</a>
</div>

</form>

</div>

</body>
</html>