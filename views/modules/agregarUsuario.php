<?php
    $stmt =	Datos::getCarrera();
    $stmt2 = Datos::getTutor();
?>

<h4>Agregar usuario</h4>
<form method="post" enctype="multipart/form-data">
    <label for="">Nombre</label>
    <input type="text" name="nombre" id=""><br>
    <label for="">Situacion:</label><br>
    <select name="situacion" id="">
        <option value="Regular">Regular</option>
        <option value="Especial">Especial</option>
    </select>
    <label for="cor">Correo:</label>
    <input type="email" name="correo" id="">
    <label for="">Suba su foto</label>
    <input name="foto" type="file" />
    <label for="carrerauploadedfiles">Carreras:</label>
    <select name="Carrera" id="carreras">
        <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value='<?php echo $datos["idCarrera"] ?>'><?php echo $datos["nombre"] ?></option>
        <?php }?>
    </select>
    <label for="tuto">Tutores:</label>
    <select name="tutores" id="tuto">
        <?php while($datos = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value='<?php echo $datos["idTutor"] ?>'><?php echo $datos["nombre"] ?></option>
        <?php }?>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php
    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $registro = new MvcController();

    //se invoca la funcion registrousuariocontroller de la clase mvccontroller;
    $registro -> registroUsuarioController();

?>