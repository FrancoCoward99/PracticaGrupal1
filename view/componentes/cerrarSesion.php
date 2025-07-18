
<?php

session_start();
session_unset(); // No elimina las variables ni las destruye, solamente las deja vacías. 
session_destroy(); //Este si elimina las variables de sesión.

header("Location: /PracticaGrupal1/view/login.php");

?>
