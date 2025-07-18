<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../accesoDatos/accesoDatos.php';
$mysqli2 = abrirConexion();

$id = $_GET['id'];

$usuario = $mysqli2->query("SELECT * FROM usuarios WHERE id = $id")->fetch_assoc();

cerrarConexion($mysqli2);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        try{

        $mysqli = abrirConexion();

        $stmt = $mysqli->prepare("UPDATE usuarios SET nombre = ?, apellido1 = ?, apellido2 = ?, edad = ?, nombreUsuario = ?, fechaActualizacion = NOW(), genero = ? WHERE id = ?");
        $stmt->bind_param("sssissi", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["edad"], $_POST["nombreUsuario"], $_POST["genero"], $id);

        if($stmt->execute()){

            cerrarConexion($mysqli);

            echo '<script> 
            alert("El usuario se actualizó correctamente.") 
            window.location.href = "listaUsuarios.php"
            </script>';

        }else{
            throw new exception("Sucedió un error al realizar la actualización del usuario.");
        }

        }catch(Exception $e){



        }
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

<h2>Editar usuario</h2>

<form method="POST">

<div class="mb-2">
    <input type="text" name="nombre" id="nombre" class="mb-4 form-control" value="<?php echo $usuario["nombre"] ?>" placeholder="Ingrese su nombre" required>
    <input type="text" name="apellido1" id="apellido1" class="mb-4 form-control" value="<?= $usuario["apellido1"] ?>" placeholder="Ingrese su primer apellido" required>
    <input type="text" name="apellido2" id="apellido2" class="mb-4 form-control" value="<?= $usuario["apellido2"] ?>"  placeholder="Ingrese su segundo apellido" required>
    <input type="number" name="edad" id="edad" class="mb-4 form-control" value="<?= $usuario["edad"] ?>"  placeholder="Ingrese su edad" required>
    <input type="email" name="nombreUsuario" id="nombreUsuario" class="mb-4 form-control" value="<?= $usuario["nombreUsuario"] ?>"  placeholder="Ingrese su correo" required>

    <!-- <input type="password" name="contrasena" id="contrasena" class="mb-4 form-control" placeholder="Ingrese su contrasenna" required> -->

    <select name="genero" id="genero" class="form-select" required>
        <option value="">Seleccione género</option>
        <option <?php if($usuario["genero"] == "M") echo 'selected' ?> value="M">Masculino</option>
        <option <?php if($usuario["genero"] == "F") echo 'selected' ?> value="F">Femenino</option>
        <option <?php if($usuario["genero"] == "O") echo 'selected' ?> value="O">Otro</option>
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