<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../accesoDatos/accesoDatos.php';

try {
    $mysqli = abrirConexion();
} catch(Exception $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correoUsuario = $_POST['txtEmail'] ?? '';
    $contrasenna = $_POST['txtPassword'] ?? '';

    if ($correoUsuario !== '' && $contrasenna !== '') {

        $sql = "SELECT id, contrasena, nombre FROM usuarios WHERE nombreUsuario = ? LIMIT 1";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param('s', $correoUsuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                // OJO: orden correcto del bind_result
                $stmt->bind_result($idUsuario, $contrasennaUsuario, $nombreUsuario);
                $stmt->fetch();
                $stmt->close();
                cerrarConexion($mysqli);

                if (password_verify($contrasenna, $contrasennaUsuario)) {
                    session_start();
                    $_SESSION["nombreUsuario"] = $nombreUsuario;
                    $_SESSION["usuarioID"] = $idUsuario;

                    header("Location: dashboard.php");
                    exit;
                } else {
                    echo 'Contraseña incorrecta.';
                }

            } else {
                echo 'El usuario indicado no existe.';
            }

        }

    } else {
        echo 'Ingrese usuario y contraseña.';
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