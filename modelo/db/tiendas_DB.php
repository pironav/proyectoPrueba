<?php

require 'conexiones/db_conect.php';

class tiendas_DB extends Db_conect       // ESTA ES LA CLASE QUE accede a la base de datos y obtiene los datos 
{                                               // vemos que es una herencia de la clase conexion
                                                // con eso tenemos acceso a las variables y metodos(funciones)// que esten definidas en la clase Conexion
   
    
    public function Conectar()      // el metodo constructor de la clase conexionl
    {
                                 // llamanos con esta instrucion al metodo constructor de la clase padre, es decir de la que se hereda en este caso de
                                 // la clase Conexion    
      parent::__construct();    
    }
    
   
     
 
    public function obtener_Categorias()
    {
   
 
      $sql= "SElECT * from categorias ORDER BY id_Categoria ASC";
 
  
    
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
    
   
   
    
    
    public function buscar_hueco_categorias() 
   /* esta funcion busca en la tabla un hueco o espacio vacio, es decir donde los id no sean consecutivos, 
    * esto es cuando el campo id lo hemos declarado autoincrementar y devuelve el id vacio o faltante o el que deberia continuar */       
    
   {
      $sql= "SELECT id_Categoria FROM categorias"; // la sentencia sql
       $sentence = $this->conexion->prepare($sql);  
       $sentence->execute();
      
       $hueco=0;//                        // contendra el hueco o donde no hay id consecutivis
       $id_Esperado=1;    // id que se espera en cada registro
       
      
       while ($id = $sentence->fetch(PDO::FETCH_ASSOC))   // recorremos todos los registros 
      {
       if ("$hueco"=="0")    
       
       {
       if (($id_Esperado) < ($id['id_Categoria'])) 
          $hueco=$id_Esperado;   
                 
       }
        $id_Esperado++; 
        }  
                   
      return $hueco;                  
    }
    
    public function buscar_hueco_articulos() 
   /* esta funcion busca en la tabla un hueco o espacio vacio, es decir donde los id no sean consecutivos, 
    * esto es cuando el campo id lo hemos declarado autoincrementar y devuelve el id vacio o faltante o el que deberia continuar */       
    
   {
      $sql= "SELECT id_Art FROM articulos"; // la sentencia sql
       $sentence = $this->conexion->prepare($sql);  
       $sentence->execute();
      
       $hueco=0;//                        // contendra el hueco o donde no hay id consecutivis
       $id_Esperado=1;    // id que se espera en cada registro
       
      
       while ($id = $sentence->fetch(PDO::FETCH_ASSOC))   // recorremos todos los registros 
      {
       if ("$hueco"=="0")    
       
       {
       if (($id_Esperado) < ($id['id_Art'])) 
          $hueco=$id_Esperado;   
                 
       }
        $id_Esperado++; 
        }  
                   
      return $hueco;                  
    }
    
    public function crear_Categoria($nombre) {
        
      /* $this->reordenar_Tabla();*/
      $hueco=$this->buscar_hueco_categorias();// buscamos a ver si hay huecos (id no consecutivos en la tabla)
                        
      if ($hueco >0)         // esto prepara para que el proximo registro se inserte en el hueco conseguido
      {
        $sql ="SET insert_id =$hueco ";
        $sentence = $this->conexion->prepare($sql);  
        $sentence->execute();   

        }

        $sql="ALTER TABLE categorias AUTO_INCREMENT = 1";    // en caso de que no haya huecos de igual forma con estas
        $sentence = $this->conexion->prepare($sql);         // intrucciones nos aseguramos se inserte al final con el id consecutivo
        $sentence->execute();                               // despues del ultimo
        $sql= "INSERT INTO categorias (nombre_Categoria) VALUES (:marcador1)"; // la sentencia sql
        $sentence = $this->conexion->prepare($sql);  // metodo implicito 

        //Ahora vinculamos el campo extraido, con el marcador

        $sentence->bindValue(":marcador1", $nombre);


        $sentence->execute();

         if($sentence)
          {
             // obtenemos el id de la categoria que se registro
            $id=$this->obtener_Id_Categoria($nombre);
          }



        //Cerramos la conexion a la base de datos
        $this->conexion = null;

         return $id;

}
  
   public function obtener_Tiendas($categoria) {
		
        $sql="SELECT * FROM tiendas WHERE categoria_Tienda=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

         $sentence = $this->conexion->prepare($sql);  // metodo implicito 

         //Ahora vinculamos el campo extraido, con el marcador
         $sentence->bindValue(":marcador1", $categoria);



         $sentence->execute();

          $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
       // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

       $sentence->closeCursor;  //cerramos la sentencia

       $this->conexion=NULL;


       return $resultado;  // devuelve $personal a donde fue invocado el metodo
    }
    public function obtener_Nombre_Categoria($categoria) {
		
    $sql="SELECT * FROM categorias WHERE id_categoria=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

     $sentence = $this->conexion->prepare($sql);  // metodo implicito 

     //Ahora vinculamos el campo extraido, con el marcador
     $sentence->bindValue(":marcador1", $categoria);



     $sentence->execute();

      $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
   // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

     if($sentence)
            {
         $nombre=$resultado[0]['nombre_Categoria'] . PHP_EOL; 

            }
      else
          {    }  



   $sentence->closeCursor;  //cerramos la sentencia

   $this->conexion=NULL;


   return $nombre;  // devuelve $personal a donde fue invocado el metodo
    }
 
                         
    public function obtener_Id_Categoria($nombre) {
		
    $sql="SELECT * FROM categorias WHERE nombre_Categoria=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

     $sentence = $this->conexion->prepare($sql);  // metodo implicito 

     //Ahora vinculamos el campo extraido, con el marcador
     $sentence->bindValue(":marcador1", $nombre);



     $sentence->execute();

      $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
   // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

      $id=$resultado[0]['id_Categoria']; 


      $sentence->closeCursor;  //cerramos la sentencia

   $this->conexion=NULL;


   return $id;  
    } 
    
    public function eliminar_imagen($id, $carpeta) {   /* aqui eleminamos la imagen asociada al articulo eliminado*/
   
    $imagen=$id;
    $path_to_file = '../imagenes/'.$carpeta.'/'.$imagen.'.jpg'; 
   
   
         if(unlink($path_to_file)) 
             { echo 'deleted successfully'; } 
         else 
           { echo 'errors occured'; } 

}
   
    public function eliminar_Categoria($id) {
               
                                   
    
    $sql="DELETE FROM categorias WHERE id_Categoria=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

    $sentence = $this->conexion->prepare($sql);  // metodo implicito 

    //Ahora vinculamos el campo extraido, con el marcador
    $sentence->bindValue(":marcador1", $id);



    $sentence->execute();

    if($sentence)
           {
             $respuesta=1;
             $carpeta='categorias';
             $this->eliminar_imagen($id,$carpeta); // eliminamos la imagen en la carpeta que la contiene
           }

     else
         { $respuesta=0;}


  $sentence->closeCursor;  //cerramos la sentencia

  $this->conexion=NULL;


  return $respuesta;  // 
    }
 
    
    
 public function editar_Categoria($nombre,$id) {
  
    $sql= "UPDATE categorias SET nombre_Categoria=:marcador2  WHERE id_Categoria=:marcador1"; // la sentencia sql
		    //   sql = " UPDATE transportistas SET nombre='" + $nombre +  "',sexo='" + $sexo + "',fecha_nacimiento='" + $fecha_nacimiento + "',telefono='" + $telefono + "',direccion='" + $direccion + "',municipio='" + $municipio + "'," + "correo='" + $correo + "',codigo_organizacion='" + $codigo_organizacion + "',condicion='" + $condicion + "'  WHERE cedula=" + $cedula + "";

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos los campos recibidos, con los marcadores
			$sentence->bindValue(":marcador1", $id);
                        $sentence->bindValue(":marcador2", $nombre);
                        

			$sentence->execute();

			 if($sentence)
                               {$respuesta=1;}
                         else
                             { $respuesta=0;}

			

			//Cerramos la conexion a la base de datos
			$this->conexion = null;
                        
                         return $respuesta;



 }

 public function obtener_Articulos($categoria) {
		
        $sql="SELECT * FROM articulos WHERE Categoria_Art=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

         $sentence = $this->conexion->prepare($sql);  // metodo implicito 

         //Ahora vinculamos el campo extraido, con el marcador
         $sentence->bindValue(":marcador1", $categoria);



         $sentence->execute();

          $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
       // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

       $sentence->closeCursor;  //cerramos la sentencia

       $this->conexion=NULL;


       return $resultado;  // devuelve $personal a donde fue invocado el metodo
    }
 
  public function obtener_Articulos_Todos() {
		
        $sql="SELECT * FROM articulos";  // la sentencia sql  usando marcadores para evitar inyeccion

         $sentence = $this->conexion->prepare($sql);  // metodo implicito 

        



         $sentence->execute();

          $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
       // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

       $sentence->closeCursor;  //cerramos la sentencia

       $this->conexion=NULL;


       return $resultado;  // devuelve $personal a donde fue invocado el metodo
    }
 
 
 public function crear_Articulo($categoria,$nombre,$precio,$descripcion) {
       
      /* $this->reordenar_Tabla();*/
      $hueco=$this->buscar_hueco_articulos();// buscamos a ver si hay huecos (id no consecutivos en la tabla)
                        
      if ($hueco >0)         // esto prepara para que el proximo registro se inserte en el hueco conseguido
      {
        $sql ="SET insert_id =$hueco ";
        $sentence = $this->conexion->prepare($sql);  
        $sentence->execute();   

        }
        
        

        $sql="ALTER TABLE articulos AUTO_INCREMENT = 1";    // en caso de que no haya huecos de igual forma con estas
        $sentence = $this->conexion->prepare($sql);         // intrucciones nos aseguramos se inserte al final con el id consecutivo
        $sentence->execute();                               // despues del ultimo
        $sql= "INSERT INTO articulos (categoria_Art,nombre_Art,precio_Art,descripcion_Art) VALUES (:marcador1,:marcador2,:marcador3,:marcador4)"; // la sentencia sql
        $sentence = $this->conexion->prepare($sql);  // metodo implicito 

        //Ahora vinculamos el campo extraido, con el marcador
        $sentence->bindValue(":marcador1", $categoria);
        $sentence->bindValue(":marcador2", $nombre);
        $sentence->bindValue(":marcador3", $precio);
        $sentence->bindValue(":marcador4", $descripcion);
        

        $sentence->execute();

         if($sentence)
          {
            if ($hueco > 0)
             {
              $id= $hueco;  // caso de que se inserto en un hueco
             }       
          else {
             // obtenemos el id de el ultimo articulo que seria el creado  
             $sql ="Select * from articulos order by id_Art DESC LIMIT 1";
             $sentence = $this->conexion->prepare($sql);         // intrucciones nos aseguramos se inserte al final con el id consecutivo
             $sentence->execute();    
            $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
           // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo
            $id=$resultado[0]['id_Art'];  
             } 
          }



        //Cerramos la conexion a la base de datos
        $this->conexion = null;

         return $id;

}
 
  public function eliminar_Articulo($id) {
               
                                   
    
    $sql="DELETE  FROM articulos WHERE id_Art=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

    $sentence = $this->conexion->prepare($sql);  // metodo implicito 

    //Ahora vinculamos el campo extraido, con el marcador
    $sentence->bindValue(":marcador1",$id);



    $sentence->execute();

    if($sentence)
           {
             $carpeta='articulos';
             $respuesta=1;
             $this->eliminar_imagen($id, $carpeta); // eliminamos la imagen en la carpeta que la contiene
           }

     else
         { $respuesta=0;}


  $sentence->closeCursor;  //cerramos la sentencia

  $this->conexion=NULL;


  return $respuesta;  // 
    }
    
    public function eliminar_Articulo_Todos_Categoria($id) {
               
                                   
    
    $sql="DELETE  FROM articulos WHERE categoria_Art=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

    $sentence = $this->conexion->prepare($sql);  // metodo implicito 

    //Ahora vinculamos el campo extraido, con el marcador
    $sentence->bindValue(":marcador1",$id);



    $sentence->execute();

    

  $sentence->closeCursor;  //cerramos la sentencia

  $this->conexion=NULL;


 // 
    }
 
  public function eliminar_Articulos_Cat($id) {
     $respuesta=1;          
    $sql="SELECT * FROM articulos where categoria_Art=:marcador1";  // la sentencia sql  usando marcadores para evitar inyeccion

         $sentence = $this->conexion->prepare($sql);  // metodo implicito 
         $sentence->bindValue(":marcador1", $id);
         $sentence->execute();
         $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
          if (resultado){
            $this->eliminar_Articulo_Todos_Categoria($id);   
          }
        



          

         
         
         $sentence->closeCursor;  //cerramos la sentencia

       $this->conexion=NULL;


       return $resultado;  // devuelve $personal a donde fue invocado el metodo
    }
 
 
   public function editar_Articulo($idArt,$idCat,$nombre,$precio,$descripcion) {
   
   $sql= "UPDATE articulos SET categoria_Art=:marcador2,nombre_Art=:marcador3,precio_Art=:marcador4,descripcion_Art=:marcador5  WHERE id_Art=:marcador1";
  //  $sql= "UPDATE articulos SET categoria_Art=:marcador2,nombre_Art=:marcador3,precio_Art=:marcador4,descripcion_Art=:marcador5  WHERE id_Art=:marcador1"; // la sentencia sql
		    //   sql = " UPDATE transportistas SET nombre='" + $nombre +  "',sexo='" + $sexo + "',fecha_nacimiento='" + $fecha_nacimiento + "',telefono='" + $telefono + "',direccion='" + $direccion + "',municipio='" + $municipio + "'," + "correo='" + $correo + "',codigo_organizacion='" + $codigo_organizacion + "',condicion='" + $condicion + "'  WHERE cedula=" + $cedula + "";

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos los campos recibidos, con los marcadores
			$sentence->bindValue(":marcador1", $idArt);
                        $sentence->bindValue(":marcador2", $idCat);
                        $sentence->bindValue(":marcador3", $nombre);
                        $sentence->bindValue(":marcador4", $precio);
                        $sentence->bindValue(":marcador5", $descripcion);
                        

			$sentence->execute();

			 if($sentence)
                               {$respuesta=1;}
                         else
                             { $respuesta=0;}

			

			//Cerramos la conexion a la base de datos
			$this->conexion = null;
                        
                         return $respuesta;



 }
  
 
 }
?>