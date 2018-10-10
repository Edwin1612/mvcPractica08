<?php
    $id = $_GET["id"];
    $stmt =	Datos::getAlumnoID($id);
    $stmt2 = Datos::getTutorID($stmt["idTutor"]);
    $stmt3 = Datos::getCarreraID($stmt["idCarrera"]);
?>
<div align="center">
    <h3>Nombre de alumno: <?= $stmt["nombre"] ?></h3>
    <h3>Situacion del alumno: <?= $stmt["situacion"] ?></h3>
    <h3>Correo: <?= $stmt["correo"] ?></h3>
    <h3>Tutor: <?= $stmt2["nombre"] ?></h3>
    <h3>Carrera: <?= $stmt3["nombre"] ?></h3>
    <img src="<?= $stmt["imagen"] ?> " alt="" width="400" height="400">
</div>