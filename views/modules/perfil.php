<?php
//Se obtiene el id por get
    $id = $_GET["id"];
    //Se piden 3 consultas el, obtener usuario espesifico, obtener tutor espesifico y obtener carrera espesifica
    $stmt =	Datos::getAlumnoID($id);
    $stmt2 = Datos::getTutorID($stmt["idTutor"]);
    $stmt3 = Datos::getCarreraID($stmt["idCarrera"]);
?>
<!--Se muestran los respetivos datos-->
<div align="center">
    <h3>Nombre de alumno: <?= $stmt["nombre"] ?></h3>
    <h3>Situacion del alumno: <?= $stmt["situacion"] ?></h3>
    <h3>Correo: <?= $stmt["correo"] ?></h3>
    <h3>Tutor: <?= $stmt2["nombre"] ?></h3>
    <h3>Carrera: <?= $stmt3["nombre"] ?></h3>
    <img src="<?= $stmt["imagen"] ?> " alt="" width="400" height="400">
</div>