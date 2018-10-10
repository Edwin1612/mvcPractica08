<?php

require_once("conexion.php");
//session_start();


class Datos extends Conexion{
        
    #Registro de usuarios
    public function registroUsuarioModel($datosModel){
        //Se convierten los ids a ocupar en int
        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        //Se prepara la consulta de insertar los datos
        $stmt = Conexion::conectar()->prepare("INSERT INTO alumnos (nombre, situacion, correo, idCarrera, idTutor,imagen) VALUES(:nombre, :situacion,
        :correo ,:idCarrera,:idTutor,:imagen) ");
        //Se transponen los valores en sus respetivos lugares
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
        //se ejecuta y muestra si se logro o hubo un problema
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }

        $stmt->close();

    }
    //Funcion que editar al usuario de parametro pide un $dataModel que son los datos en un array del controllador
    public function editarUsuarioModel($datosModel){
        //Los ids se convierten en int
        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        $id= (int)$datosModel["id"];
        //Se prepara la consulta update
        $stmt = Conexion::conectar()->prepare("UPDATE alumnos  SET nombre=:nombre, situacion=:situacion, correo=:correo, idCarrera=:idCarrera, idTutor=:idTutor,imagen=:imagen  WHERE idAlumno=:id ");
        //Se transponen los valores en sus respetivos lugares
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
        //Se ejecuta la sentencia sql
        if($stmt->execute()){
            return 1;
        }else{
            return 0;
        }

        $stmt->close();

    }
    //Funcion que returna todos los usuarios
    public function getUsuarios()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from alumnos');
        $stmt->execute();
        return $stmt;
    }
    //Funcion que returna todos los tutores
    public function getTutor()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from tutores');
        $stmt->execute();
        return $stmt;
    }
    //Funcion que returna todas las carreras
    public function getCarrera()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from carreras');
        $stmt->execute();
        return $stmt;
    }

    //Funcion que returna un tutor en particular, parametros idTUtor
    public function getTutorID($id)
    {
        //Se prepara la sentencia 
        $stmt = Conexion::conectar()->prepare('SELECT *from tutores where idTutor=:id');
        //Se interncambian los valores 
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        //EL resultado de la sentencia se hace un array asociativo
        $result = $stmt->fetch();
        //y se return el array
        return $result;
    }
    //Funcion que returna un alumno en particular, parametros idAlumno
    public function getAlumnoID($id)
    {
        //Se prepara la sentencia 
        $stmt = Conexion::conectar()->prepare('SELECT *from alumnos where idAlumno=:id');
        //Se interncambian los valores 
        $stmt->bindParam(":id",$id);
        //EL resultado de la sentencia se hace un array asociativo
        $stmt->execute();
        $result = $stmt->fetch();
        //y se return el array
        return $result;
    }
    //Funcion que regresa una carrera en particular
    public function getCarreraID($id)
    {
        //Se prepara la sentencia 
        $stmt = Conexion::conectar()->prepare('SELECT *from carreras where idCarrera=:id');
        //Se interncambian los valores 
        $stmt->bindParam(":id",$id);
        //EL resultado de la sentencia se hace un array asociativo
        $stmt->execute();
        $result = $stmt->fetch();
        //y se return el array
        return $result;
    }

    //Se borra un alumno en espesifico, parametros el idAlumno
    public function deleteUsuario($id)
    {
        //Se crea la sentencia delete
        $stmt = Conexion::conectar()->prepare('DELETE from alumnos where idAlumno=:id');
        $stmt->bindParam(":id",$id);
        //se cambian los valore en este caso el id, y se ejecuta
        $stmt->execute();
    } 
   

}