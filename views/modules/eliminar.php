<?php
//Se toma el id por metodo get
    $id = $_GET["id"];
    //Invocar el metodo para borrar usuarios pasando de parametro el id
    $stmt =	Datos::deleteUsuario($id);
    //Y hace un header a la vista usuarios
    header("Location: index.php?action=usuarios");
?>