<?php
    $id = $_GET["id"];
    $stmt =	Datos::deleteUsuario($id);
    header("Location: index.php?action=usuarios");
?>