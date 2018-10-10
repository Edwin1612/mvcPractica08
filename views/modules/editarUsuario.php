<?php
    $stmt =	Datos::getCarrera();
    $stmt2 = Datos::getTutor();
    //Se piden todos los datos de carreras y tutores y se guardan en sus respetivas variables
    if(isset($_GET["id"])){
        //se verifica si la variable id por get es cachada y si lo es, hace un $_Get para obtenerla
        //Una vez obtenida hacer uso del metodo GetAlumnoID que regresa un alumno en particular con ese id
    $id2 = $_GET["id"];
    $stmt3 = Datos::getAlumnoID($id2);
    }
    
    
?>
<!--Formulario que muestra los valores en los inputs del alumno obtenido por la sentencia GetAlumnoID-->
<h4>Agregar usuario</h4>
<form method="post" action="index.php?action=editarUsuario&id=<?=$id2 ?>" enctype="multipart/form-data">
    <label for="">Nombre</label>
    <input type="text" name="nombre" value="<?=$stmt3["nombre"] ?>"><br>
    <label for="">Situacion:</label><br>
    <select name="situacion" id="">
        <option value="Regular">Regular</option>
        <option value="Especial">Especial</option>
    </select>
    <label for="cor">Correo:</label>
    <input type="email" name="correo" value="<?=$stmt3["correo"] ?>">
    <label for="">Suba su foto</label>
    <input name="foto" type="file" />
    <label for="carrerauploadedfiles">Carreras:</label>
    <select name="Carrera" id="carreras">
        <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //Muestra las carreras en el select y el valor que tienen al selecionar sera el id
        ?>
        <option value='<?php echo $datos["idCarrera"] ?>'><?php echo $datos["nombre"] ?></option>
        <?php }?>
    </select>
    <label for="tuto">Tutores:</label>
    <select name="tutores" id="tuto">
        <?php while($datos = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            //Muestra los tutores en el select y el valor que tienen al selecionar sera el id
        ?>
        <option value='<?php echo $datos["idTutor"] ?>'><?php echo $datos["nombre"] ?></option>
        <?php }?>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php
    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $registro = new MvcController();

  //Se invoca el metodo editarUsuarioCOntroller
    $resputaldo = $registro -> editarUsuarioController();
    
    if($resputaldo==1)//La espuesta del metodo es 1 hace un header al index con una variable get que se llama action
    //con el valor de usuarios para que muestre la vista usuarios
    {
        header("Location: index.php?action=usuarios");
    }
?>
