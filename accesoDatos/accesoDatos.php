<?php


function abrirConexion(){

try{

    $host = "127.0.0.1";
    $user = "root";
    $password = "Admin123*";
    $db = "BD_AWCS_IIC25";

    $mysqli = new mysqli($host, $user, $password, $db);

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

    if($mysqli instanceof myqsli){
        $mysqli->close();
    }

}

?>