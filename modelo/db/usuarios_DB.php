<?php

require 'conexiones/db_conect.php';

class Usuarios_DB extends Db_conect       // ESTA ES LA CLASE QUE accede a la base de datos y obtiene los datos 
{                                               // vemos que es una herencia de la clase conexion
                                                // con eso tenemos acceso a las variables y metodos(funciones)// que esten definidas en la clase Conexion
   
    
    public function Conectar()      // el metodo constructor de la clase conexionl
    {
                                 // llamanos con esta instrucion al metodo constructor de la clase padre, es decir de la que se hereda en este caso de
                                 // la clase Conexion    
      parent::__construct();    
    }
    
   
     
  public function crear_Usuario($nombre,$userName,$password,$nivel,$descripcion) {
                        
                        $privilegios="";
                        if ($nivel == 1){$privilegios="Ver - Actualizar y Eliminar Registros";}
                        if ($nivel == 2){$privilegios="Ver y Actualizar Registros";};
                        if ($nivel == 3){$privilegios="Ver Registros";};
                       
                        
                        
                        $sql= "INSERT INTO usuarios (name,username,password,nivel,privilegios,descripcion) VALUES (:marcador1,:marcador2,:marcador3,:marcador4,:marcador5,:marcador6)"; // la sentencia sql
		

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos el campo extraido, con el marcador
			$sentence->bindValue(":marcador1", $nombre);
                        $sentence->bindValue(":marcador2", $userName);
                        $sentence->bindValue(":marcador3", $password);
                        $sentence->bindValue(":marcador4", $nivel);
                        $sentence->bindValue(":marcador5", $privilegios);
                        $sentence->bindValue(":marcador6", $descripcion);

			$sentence->execute();

			 if($sentence)
                               {$respuesta=1;}
                         else
                             { $respuesta=0;}

			

			//Cerramos la conexion a la base de datos
			$this->conexion = null;
                        
                         return $respuesta;

		} 
     
   public function consultar_Usuario($nombreUsuario) {
		
                       $sql="SELECT * FROM usuarios WHERE username=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos el campo extraido, con el marcador
			$sentence->bindValue(":marcador1", $nombreUsuario);

			

			$sentence->execute();

			 $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
                      // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

                      $sentence->closeCursor;  //cerramos la sentencia
   
                      $this->conexion=NULL;


                      return $resultado;  // devuelve $personal a donde fue invocado el metodo
    }
   
 // creamos el metodo que obtendra los datos de la base de datos, de los clientes  , luego lo guarda en un Array Asociativo 
    public function obtener_Usuarios()
    {
   
 
      $sql= "SElECT * from usuarios";
 
  
    
    $sentencia= $this->conexion->prepare($sql); //preparamosla consulta llamando al metodo prepare del objeto conexion_db
// de la clase Conexion al cual tenemos acceso gracias a la herencia y nos devuelve un objeto que llamaremos sentencia

  
   
   $sentencia->execute();  // ejecutamos la sentencia invocando al metodo execute del objeto sentencia

//
   $resultado=$sentencia->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
   // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

   $sentencia->closeCursor;  //cerramos la sentencia
   
   $this->conexion=NULL;


  return $resultado;  
    }
  
  public function editar_Usuario($nuevoUserName,$userName,$nombre,$password,$nivel,$descripcion) {
		
                     $privilegios="";
                        if ($nivel == 1){$privilegios="Ver - Actualizar y Eliminar Registros";}
                        if ($nivel == 2){$privilegios="Ver y Actualizar Registros";};
                        if ($nivel == 3){$privilegios="Ver Registros";};
                        
                    $sql= "UPDATE usuarios SET username=:marcador1,name=:marcador2,password=:marcador3,nivel=:marcador4,privilegios=:marcador5,descripcion=:marcador6  WHERE username=:marcador7"; // la sentencia sql
		    //   sql = " UPDATE transportistas SET nombre='" + $nombre +  "',sexo='" + $sexo + "',fecha_nacimiento='" + $fecha_nacimiento + "',telefono='" + $telefono + "',direccion='" + $direccion + "',municipio='" + $municipio + "'," + "correo='" + $correo + "',codigo_organizacion='" + $codigo_organizacion + "',condicion='" + $condicion + "'  WHERE cedula=" + $cedula + "";

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos los campos recibidos, con los marcadores
			$sentence->bindValue(":marcador1", $nuevoUserName);
                        $sentence->bindValue(":marcador2", $nombre);
                        $sentence->bindValue(":marcador3", $password);
                        $sentence->bindValue(":marcador4", $nivel);
                        $sentence->bindValue(":marcador5", $privilegios);
                        $sentence->bindValue(":marcador6", $descripcion);
                        $sentence->bindValue(":marcador7", $userName);
                         
			$sentence->execute();

			 if($sentence)
                               {$respuesta=1;}
                         else
                             { $respuesta=0;}

			

			//Cerramos la conexion a la base de datos
			$this->conexion = null;
                        
                         return $respuesta;

		} 
 public function eliminar_Usuario($nombreUsuario) {
               
              $sql="DELETE FROM usuarios WHERE username=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos el campo extraido, con el marcador
			$sentence->bindValue(":marcador1",$nombreUsuario );

			

			$sentence->execute();

			if($sentence)
                               {
                                 $respuesta=1;
                               //  $this->eliminar_imagen($id, $categoria); // eliminamos la imagen en la carpeta que la contiene
                               }
                               
                         else
                             { $respuesta=0;}


                      $sentence->closeCursor;  //cerramos la sentencia
   
                      $this->conexion=NULL;


                      return $respuesta;  //                       
                      
    }
 
                         
                
   
    
}

?>