<?php


function abrirConexion(){

try{

    $host = "localhost";
    $user = "root";
<<<<<<< HEAD
    $password = "";
    $db = "BD_AWCS_IIC25";
=======
    $password = "hola";
    $db = "bd_awcs_iic25";
    $port = 3307;
>>>>>>> María

    $mysqli = new mysqli($host, $user, $password, $db, $port);

    if($mysqli->connect_error){
        throw new exception("Sucedió un error al realizar la conexión a la base de datos.");
    }

    $mysqli->set_charset('utf8mb4');

    return $mysqli;

}catch (Exception $e){

    return false;
}

}

function cerrarConexion($mysqli){

    if($mysqli instanceof mysqli){
        $mysqli->close();
    }

}

?>
