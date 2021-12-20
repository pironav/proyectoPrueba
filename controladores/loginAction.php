<?php
require '../modelo/login_M.php';

// para evitar la inteccion y por medidas de seguridad sabiendo se trata de un login que es la entrada al sistema
//    se realiza lo siguiente : La funcion HTML_ENTITIES CONVIERTE TODOS LOS CARACTERES A ENTIDADES HTML Y LUEGO la funcion addcslashes escapa todos los caracteres extraNos
// tales como ",'(,#$% u otros con los que se podria atacar la base de datos con una inyeccion
$usuario=htmlentities(addslashes($_POST["usuario"]));
$password=htmlentities(addslashes($_POST["password"]));

 try {




$conexion = new login_M;      /* instanciamos la clase Login_M que esta en la carpeta modelo y creamos un objeto llamado conexion*/
$encontrado = $conexion->confirmarUsuario($usuario,$password); /*llamamos al metodo confirmar usuario de dicho objeto pasandole los parametros usuario y password */
                                                               /* el valor devuelto por el metodo se lo asignamos a la variable $encontrado */
session_start();// iniciamos sesion de usuarios
if($encontrado==1)
     {
      $conexion = new login_M; 
      $USUARIO=$conexion->obtenerUsuario($usuario, $password);
      $nombreUsuario=$USUARIO[0]['name'];
      $nivelUsuario=$USUARIO[0]['nivel'];
     
       
     
     
      
      $_SESSION["usuario"]=$nombreUsuario; // creamos una variable super global llamada usuario cuyo valor es lo recuperado delformulario
       $_SESSION["nivel_usuario"]=$nivelUsuario; 
      // y que guardamos en $usuario
       header('location:../inicioAdministrador.php');    /* dirijimos a la pagina adminInicio.php */
     }
   else
     {
       header("location:../login.php?error=1"); //si no encuentra registro es decir devolvio 0, entonces redirijimos a la pagina login.php
     }
}
          
catch (Exception $exc) {
   echo $exc->getTraceAsString();
}
?>
   
