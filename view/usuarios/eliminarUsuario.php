<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../accesoDatos/accesoDatos.php';
$mysqli = abrirConexion();

$id = $_GET['id'];

$mysqli->query("DELETE FROM usuarios WHERE id = $id");

            echo '<script> 
            alert("El usuario se eliminó correctamente.") 
            window.location.href = "listaUsuarios.php"
            </script>';

?>

