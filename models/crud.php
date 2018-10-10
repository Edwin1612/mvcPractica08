<?php

require_once("conexion.php");
//session_start();


class Datos extends Conexion{
        
    #Registro de usuarios
    public function registroUsuarioModel($datosModel){

        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        $stmt = Conexion::conectar()->prepare("INSERT INTO alumnos (nombre, situacion, correo, idCarrera, idTutor,imagen) VALUES(:nombre, :situacion,
        :correo ,:idCarrera,:idTutor,:imagen) ");
        
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }

        $stmt->close();

    }

    public function editarUsuarioModel($datosModel){

        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        $id= (int)$datosModel["id"];
        $stmt = Conexion::conectar()->prepare("UPDATE alumnos  SET nombre=:nombre, situacion=:situacion, correo=:correo, idCarrera=:idCarrera, idTutor=:idTutor,imagen=:imagen  WHERE idAlumno=:id ");
        
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);

        if($stmt->execute()){
            return 1;
        }else{
            return 0;
        }

        $stmt->close();

    }

    public function getUsuarios()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from alumnos');
        $stmt->execute();
        return $stmt;
    }

    public function getTutor()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from tutores');
        $stmt->execute();
        return $stmt;
    }

    public function getCarrera()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from carreras');
        $stmt->execute();
        return $stmt;
    }

    
    public function getTutorID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from tutores where idTutor=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getAlumnoID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from alumnos where idAlumno=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    
    public function getCarreraID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from carreras where idCarrera=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function deleteUsuario($id)
    {
        $stmt = Conexion::conectar()->prepare('DELETE from alumnos where idAlumno=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    } 
   /* public function IniciarSesionModel($datosModel)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario WHERE usuario=:usuario && contrasena=:contrasea');
        $stmt->bindParam(":usuario", $datosModel["usuario"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasea", $datosModel["password"], PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()==1){
            session_start();
            $_SESSION["usuario"]=$datosModel["usuario"];
            $_SESSION["contrasena"]=$datosModel["password"];
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function getUsuarios()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario');
        $stmt->execute();
        return $stmt;
    }

    public function getUsuariosID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    //Metodo que con mediante setencias sql con PDO se editan datos, agrege el MD5 por seguridad ya que envio la contraseña de la sesion por get, para que no puedan
    //obtener la contraseña de una manera facil
    public function updateUsuariosModel($datosModel)
    {
            $stmt = Conexion::conectar()->prepare("UPDATE usuario SET usuario=:usuario, contrasena=:contrasena, correo=:correo WHERE idUsuario=:id");
            $stmt->bindParam(":usuario",$datosModel["usuario"]);
            $stmt->bindParam(":contrasena",$datosModel["contrasena"]);
            $stmt->bindParam(":correo",$datosModel["correo"]);
            $stmt->bindParam(":id",$datosModel["id"]);
            if($stmt->execute())
            {
                return "success";
            }
            else 
            { return "error";}
    }
    //Metodo que elimina al usuario con sentencia sql y PDO , al igual que el de editar se agrega la contraseña para saber si sera capaz de poder elimianr la info
    public function eliminarUsuario($datosModel){
        if(MD5($datosModel["Pas1"])== $datosModel["Pas2"])
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM usuario WHERE idUsuario=:id");
            $stmt->bindParam(":id",$datosModel["id"]);
            if($stmt->execute())
            {
                return "success";
            }
        }else
        {
            return "error";
        }

    }*/

}