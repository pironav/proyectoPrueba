<?php
	
require 'db/tiendas_DB.php';

class Tiendas 

{
  public function crear_Categoria ($nombre) 
  {
    $tienda = new tiendas_DB();	                  
     $id=$tienda->crear_Categoria($nombre); // se manda a registrar la categoria y nos devuelve el id con que la creo
     if ($id)
       {
         $respuesta= $this->guardar_Imagen_Categoria($id);           
                     
        }    
                                                                         
     return $respuesta;      
     
 }
		
    public function guardar_Imagen_Categoria ($id) 
   // moveremos la imagen guardada en la carpeta temporal que fue la que selecciono el usaurio al solicitar la creacion
   // de esta categoria que se esta registrando 
    {  
     
     $source_file = '../imagenes/temporal/imgTemporal.jpg';
     $destination_path = '../imagenes/categorias/';
      rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME)); 
      
      if (rename);
         {
         // despues de moverla le cambiamos el nombre el cual va ser el id de la categoria
         rename ("../imagenes/categorias/imgTemporal.jpg", "../imagenes/categorias/$id.jpg");
         $respuesta='TRUE';
                  
          }         
          return $respuesta;     
                     
    }   
    
    
     public function guardar_Imagen_Articulo ($id) 
   // moveremos la imagen guardada en la carpeta temporal que fue la que selecciono el usaurio al solicitar la creacion
   // de esta categoria que se esta registrando 
    {  
     
     $source_file = '../imagenes/temporal/imgTempCrearArt.jpg';
     $destination_path = '../imagenes/articulos/';
      rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME)); 
      
      if (rename);
         {
         // despues de moverla le cambiamos el nombre el cual va ser el id de la categoria
         rename ("../imagenes/articulos/imgTempCrearArt.jpg", "../imagenes/articulos/$id.jpg");
         $respuesta='TRUE';
                  
          }         
          return $respuesta;     
                     
    }    
    
      public function editar_Imagen_Articulo ($id) 
   // moveremos la imagen guardada en la carpeta temporal que fue la que selecciono el usaurio al momento
   // de editar un articulo, ssolo sera efectiva si selecciono otra imagen la cual se debio haber guardado en la carpeta temporal
    {  
     
     $source_file = '../imagenes/temporal/imgTempEditArt.jpg';
     $destination_path = '../imagenes/articulos/';
      rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME)); 
      
      if (rename);
         {
         // despues de moverla le cambiamos el nombre el cual va ser el id de la categoria
         rename ("../imagenes/articulos/imgTempEditArt.jpg", "../imagenes/articulos/$id.jpg");
         $respuesta='TRUE';
                  
          }         
          return $respuesta;     
                     
    }      
            
                
                
    public function obtener_Id_Categoria ($nombre) {

     $tienda = new tiendas_DB();	                  
     $id=$tienda->obtener_Id_Categoria($nombre);  

       return $id;       
    }


    public function obtener_Categorias () {

     $tiendas = new tiendas_DB();	                   /* instanciamos la clase Tiendas_DB*/
     $categorias=$tiendas->obtener_Categorias();  /* y luego invocamos el metodo de esta llamado obtener_Categorias*/ 

       return $categorias;        /* devolvemos las categorias encontrados */
    }
    
    
     public function eliminar_imagen($id, $carpeta) {   /* aqui eleminamos la imagen asociada al articulo eliminado*/
   
    $imagen=$id;
    $path_to_file = '../imagenes/'.$carpeta.'/'.$imagen.'.jpg'; 
   
   
         if(unlink($path_to_file)) 
             { echo 'deleted successfully'; } 
         else 
           { echo 'errors occured'; } 

}
    
    
    
      public function eliminar_Imagenes($lista) {
      $nroFila=0;
      $cont=count($lista);
     
      while($cont>0)
      {
       $idArt=$lista[$nroFila]['id_Art']; 
       $carpeta='articulos';
       $this->eliminar_imagen($idArt, $carpeta);
       $cont=$cont-1;
       $nroFila=$nroFila+1;
      }
     
           
    }

    public function eliminar_Categoria ($id) {

     $tiendas = new tiendas_DB();
     
     $respuesta=$tiendas->eliminar_Categoria($id);  /* y luego invocamos el metodo de esta llamado eliminar_Categorias*/ 
     $tiendas2 = new tiendas_DB();
     $listaIdEliminados=$tiendas2->eliminar_Articulos_Cat($id);/* instanciamos la clase Tiendas_DB*/ 
     $this->eliminar_Imagenes($listaIdEliminados);
     // $idArt=$listaIdEliminados[0]['id_Art'];
    return $respuesta;   
    }


     public function obtener_Tiendas ($categoria) {

     $tiendas = new tiendas_DB();	                   /* instanciamos la clase tienda  que se encuentra en el archivo tiendas_DB.php*/
     $listaTiendas=$tiendas->obtener_Tiendas($categoria);  /* almacenamos en $respuesta el valor recibido del metodo obtener tiendas  */ 

       return $listaTiendas;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
    }

     public function obtener_Nombre_Categoria ($categoria) {

     $tiendas = new tiendas_DB();	                 
     $nombreCategoria=$tiendas->obtener_Nombre_Categoria($categoria);  

       return $nombreCategoria;       
    }
    
    public function editar_categoria ($nombre,$id)
    {
        $tiendas = new tiendas_DB(); 
         // editamos el nombre de la categoria )unico valor que cambiaria)
          $respuesta=$tiendas->editar_Categoria($nombre, $id);  
         // verificamos si se va a actualizar la imagen esto lo hacemos verificando si hay
         // un imagen llamada imgEdiTemp en la carpeta imagenes/temporal , recordar alli se guarda y con ese nombre la imagen seleccionada por el usuario
        // si este accedio al proseso buscar imagen2 para cambiar la imagen
      
      if ($respuesta = 1)
      {
         $foto = '../imagenes/temporal/imgEdiTemp.jpg'; // ese nombre es con el que se guarda siempre caso editar
        if (file_exists($foto)) {
      // le cambiamos el nombre por el que debe llevar asociado al id      
       rename ("../imagenes/temporal/imgEdiTemp.jpg", "../imagenes/temporal/$id.jpg");      
            
      // luego movemos la imagen de la carpeta temporal a la carpeta categorias      
     $source_file = "../imagenes/temporal/$id.jpg";
     $destination_path = "../imagenes/categorias/";
      rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME));   
            
        }
      } 
          
    }      
     
    
    public function obtener_Articulos_todos () {

     $tiendas = new tiendas_DB();	                   /* instanciamos la clase tienda  que se encuentra en el archivo tiendas_DB.php*/
     $listaArticulos=$tiendas->obtener_Articulos_Todos();  /* almacenamos en $respuesta el valor recibido del metodo obtener tiendas  */ 

       return $listaArticulos;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
    }
           
     
    
    
    public function obtener_Articulos ($categoria) {

     $tiendas = new tiendas_DB();	                   /* instanciamos la clase tienda  que se encuentra en el archivo tiendas_DB.php*/
     $listaArticulos=$tiendas->obtener_Articulos($categoria);  /* almacenamos en $respuesta el valor recibido del metodo obtener tiendas  */ 

       return $listaArticulos;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
    }
    
  public function crear_Articulo ($categoria,$nombre,$precio,$descripcion) 
  {
      
    $tienda = new tiendas_DB();	                  
     $id=$tienda->crear_Articulo($categoria,$nombre,$precio,$descripcion); // se manda a registrar la categoria y nos devuelve el id con que la creo
     
     if ($id)
       {
          $respuesta= $this->guardar_Imagen_Articulo($id);         
                     
        }    
                                                                         
     return $respuesta;      
     
 } 
    
  public function eliminar_Articulo ($id) {

     $tiendas = new tiendas_DB();	                   /* instanciamos la clase Tiendas_DB*/
     $respuesta=$tiendas->eliminar_Articulo($id);  /* y luego invocamos el metodo de esta llamado eliminar_Categorias*/ 

       return $respuesta;        /* devolvemos las categorias encontrados */
    }   
    
    
    public function editar_Articulo($idArt,$idCat,$nombreArt,$precio,$descripcion)
  {
    
    $tienda = new tiendas_DB();	                  
     $respuesta=$tienda->editar_Articulo($idArt,$idCat,$nombreArt,$precio,$descripcion); // se manda a registrar la categoria y nos devuelve el id con que la creo
     
     if ($respuesta=1)
       {
          // este proceso solo sera efectivo si se modifico la imagen sini no deberia hacer nada
          $respuesta= $this->editar_Imagen_Articulo($idArt);         
                     
        }    
                                                                         
     return $respuesta;      
     
 }  
    
    
    
    
    
    

	}

?>