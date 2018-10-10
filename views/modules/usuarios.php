<div align="center">
    <a href="index.php?action=agregarUsuario">Agregar Usuarios</a>
</div>

	<h1>Usuarios</h1>
	<hr >
	<?php
	if (1==1) {
		# code...
	}
	//Pagina que hace mediante una tabla, la proyecion de todos los datos de la tabla alumnos
	if(1==1){
		$stmt =	Datos::getUsuarios();
		
		?>
<div align="center">
		<table>
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Situacion academica</th>
				<th>Correo</th>
				<th>Carrera</th>
				<th>Tutor</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
		<?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC))
		//Se hace un array asociativo para poder sacar los valores
			{?>
				
				<tr>
					<td><?php echo 153000 + $datos['idAlumno'] ?></td>
					<td><a href="index.php?action=perfil&id=<?= $datos['idAlumno'] ?>"><?= $datos['nombre'] ?></a></td>
					<td><?= $datos['situacion'] ?></td>
					<td><?= $datos['correo'] ?></td>
					<?php
						$stmt2= Datos::getTutorID($datos['idTutor']);
						//se en particular un tutor con el id del alumno como parametro
						$stmt3= Datos::getCarreraID($datos['idCarrera']);
						//Se pide en particular una carrera con el ide de la carrera del usuario
					?>
					<td><?= $stmt3['nombre'] ?></td>
					<td><?= $stmt2['nombre'] ?></td>
					<td><a href="index.php?action=editarUsuario&id=<?= $datos['idAlumno'] ?>">Editar</a></td>
					<td><a href="index.php?action=eliminar&id=<?= $datos['idAlumno'] ?>">Eliminar</a></td>
				</tr>
			<?php }?>

		</tbody>
		</table>
</div>
		<?php
	}else
	{
		//Si no se puede iniciar sesion hacer un header con el action en ingresar el cual es una pagina para iniciar sesion.
		header("location:index.php?action=ingresar");
	}
	?>
