<?php
        


function categoriasTienda()
 {
  require 'modelo/tiendas_M.php';      
  $tiendas=new Tiendas;    // creamos una instancia o un objeto de la clase Proveedores  , que se encuentra en la carpeta modelo 
  $listaCategorias=$tiendas->obtener_categorias();// invocamos el metodo obtener proveedores 
  return $listaCategorias;
  } 
  
  function copiarImagen($id)   // copiamos una imagen a la carpeta temporal
 {
  $source_file = "imagenes/categorias/$id.jpg";
     $destination_path = "imagenes/temporal/";
      copy($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME)); 
      rename("imagenes/temporal/$id.jpg", "imagenes/temporal/imgEdiTemp.jpg");

    
      
  } 
  
  

  
