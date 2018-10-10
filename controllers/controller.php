<?php

class MvcController{ 
    //Llamar a la plantilla
    public function pagina(){
        //Include se utiliza para invocar el arhivo que contiene el codigo HTML
        include "views/template.php";
    }

    //Interacción con el usuario
    public function enlacesPaginasController(){
        //Trabajar con los enlaces de las páginas
        //Validamos si la variable "action" viene vacia, es decir cuando se abre la pagina por primera vez se debe cargar la vista index.php

        if(isset($_GET['action'])){
            //guardar el valor de la variable action en views/modules/navegacion.php en el cual se recibe mediante el metodo get esa variable
            $enlaces = $_GET['action'];
        }else{
            //Si viene vacio inicializo con index
            $enlaces = "index";
        }

        //Mostrar los archivos de los enlaces de cada una de las secciones: inicio, nosotros, etc.
        //Para esto hay que mandar al modelo para que haga dicho proceso y muestre la informacions

        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
    }

    //Funcion que registra al usuario
    public function registroUsuarioController(){
        if(isset($_POST["nombre"]) && isset($_POST["situacion"]) && isset($_POST["correo"]) &&
        isset($_POST["Carrera"]) && isset($_POST["tutores"]) && isset($_FILES['foto'])){
            //Recibe a traves del metodo POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email)
            
            //Array de las posibles extenciones de las imagenes subidas
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
            //El tamaño de la imagen, es que lo pide de parametro
            $max_tamanyo = 1024 * 1024 * 8;
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                     //echo 'Pesa menos de 1 MB';
                }
           }
           //Ruta que le daremos
            $ruta_indexphp = dirname(realpath(__FILE__));
            //Ruta origen
            $ruta_fichero_origen = $_FILES['foto']['tmp_name'];
            //Ruta destino
            $ruta_nuevo_destino = 'imagenes/' .rand(1,1000000). $_FILES['foto']['name'];
            //Se identifica si los datos estan 
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                //Si la imagen es menor del tamaño que nosotros queremos
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                    //echo 'Pesa menos de 1 MB';
                    //Se mueve a la carpeta 
                    if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
                        echo 'Fichero guardado con éxito';
                    }
                }
            }
            //Se enviand todos los datos
            $datosController = array("nombre" => $_POST["nombre"],
                                     "situacion" => $_POST["situacion"],
                                     "correo" => $_POST["correo"],
                                    "carrera"=> $_POST["Carrera"],
                                    "tutor"=> $_POST["tutores"],
                                    "imagen"=> $ruta_nuevo_destino);

            
            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel), que en la clase "Datos" la funcion "registrousuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::registroUsuarioModel($datosController);

            //Se imprime la respuesta en la vista
            return $respuesta;
        }else
        {
            return "no entro";

        }
    }
    //Funcion para editar los usuarios
    public function editarUsuarioController(){
            //Se verifican si todos los valors de los inputs del formulario fueron ingresados
        if(isset($_POST["nombre"]) && isset($_POST["situacion"]) && isset($_POST["correo"]) &&
        isset($_POST["Carrera"]) && isset($_POST["tutores"]) && isset($_GET["id"]) && isset($_FILES['foto'])){
            //El mismo proceso para cargar la imagen
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
            $max_tamanyo = 1024 * 1024 * 8;
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                     //echo 'Pesa menos de 1 MB';
                }
           }
            $ruta_indexphp = dirname(realpath(__FILE__));
            $ruta_fichero_origen = $_FILES['foto']['tmp_name'];
            $ruta_nuevo_destino = 'imagenes/'.rand(1,1000000) . $_FILES['foto']['name'];
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                    //echo 'Pesa menos de 1 MB';
                    if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
                        echo $ruta_nuevo_destino;
                    }
                }
            }

            //Recibe a traves del metodo POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email)
            $datosController = array("nombre" => $_POST["nombre"],
                                     "situacion" => $_POST["situacion"],
                                     "correo" => $_POST["correo"],
                                    "carrera"=> $_POST["Carrera"],
                                    "tutor"=> $_POST["tutores"],
                                    "id"=> $_GET["id"],
                                    "imagen"=> $ruta_nuevo_destino);
            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel), que en la clase "Datos" la funcion "registrousuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::editarUsuarioModel($datosController);

            //Se imprime la respuesta en la vista
            return $respuesta;
        }else
        {
            return "no entro";

        }
    }
}

?>