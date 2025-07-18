<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
Sem 8
*/

// $carros = array("Toyota", "Nissan", "Mitsubishi", "Honda", "Chery");
// $carros2 = array("Subaru", "Changan", "Land Rover");

// $carros23 = array(1, 2, 3, 4, 5);

// $arrayUnificado = array_merge($carros, $carros2, $carros23);

// print_r($carros23);

// // print_r($carros);

// // echo $carros[5];

// array_push($carros, "Mazda");
// // print_r($carros);

// // $posicion = array_search("Nissan", $carros);
// // echo $posicion;
// die;

require_once '../accesoDatos/accesoDatos.php';

try{
    $mysqli = abrirConexion();
}catch(Exception $e){
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}

// echo "Hola. <br/>";

// $nombre = 'Eduardo';

// if($nombre == 'Eduardo'){
//     // echo 'Hola Eduardo';
//      echo '<script> alert("Eduardo bienvenido.")</script>';
// }

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $correoUsuario = $_POST['txtEmail'] ?? '';
    $contrasenna = $_POST['txtPassword'] ?? '';

    echo $correoUsuario;
    echo $contrasenna;

    // echo password_hash($contrasenna, PASSWORD_DEFAULT);

    if($correoUsuario !== '' && $contrasenna !== ''){

        $sql = "SELECT contrasena, nombre FROM usuarios WHERE nombreUsuario = ? LIMIT 1";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('s', $correoUsuario);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows === 1){
                
                $stmt->bind_result($contrasennaUsuario, $nombreUsuario);
                $stmt->fetch();

                $stmt->close();
                cerrarConexion($mysqli);

                // echo password_hash($contrasennaUsuario, PASSWORD_DEFAULT);
                // echo '<br/>';

                // if($contrasenna === $contrasennaUsuario){
                //     echo 'Login exitoso. Bienvenido: ' . $nombreUsuario;
                //     // header("Location: dashboard.html");
                // }else{
                //     echo 'contrasenna incorrecta.';
                // }
                
                if(password_verify($contrasenna, $contrasennaUsuario)){

                    session_start();

                    $_SESSION["nombreUsuario"] = $nombreUsuario;

                    echo 'Login exitoso. Bienvenido: ' . $nombreUsuario;

                    echo '<script> console.log("Inicio de sesión exitoso.") </script>';

                    header("Location: dashboard.php");

                }else{
                    echo 'contrasenna incorrecta.';
                }
                

            }else{
                echo 'El correo indicado no existe.';
            }

        }

    }else{
        echo 'Ingrese usuario y contrasenna.';
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
    <!-- <script src="../scripts/login.js"></script> -->
    <!-- <link rel="stylesheet" href="/styles/style.css"> -->
    <title>Inicio Sesión</title>
</head>

<body>

    <div class="bg-light">

        <div class="container d-flex justify-content-center align-items-center min-vh-100">

            <div class="card p-4 shadow-lg w-100">
                <h3 class="card-title text-center mb-4"> <?php echo 'Login';?> </h3>

                <form id="loginForm" action="" method="post">

                    <div class="input-group mb-3">
                        <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                        <input class="form-control" type="email" name="txtEmail" id="txtEmail"
                            placeholder="Correo Electrónico">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                        <input class="form-control" type="password" name="txtPassword" id="txtPassword"
                            placeholder="Contraseña">
                    </div>

                    <button class="btn btn-primary" type="submit">Iniciar</button>

                </form>

                <div id="loginError" class="alertaError text-danger mt-3" style="display: none;">Credenciales Inválidas</div>

                <p class="text-center mt-3 "> No tiene una cuenta? <a href="index.php">Regístrese acá</a> </p>

            </div>

        </div>

    </div>

</body>

</html>