<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo Tiendas_M.php
  $categoria=$_GET[categoria];  // obtenemos el id de tipo de tienda a buscar 
 
 
  $tiendas=new Tiendas();    // creamos una instancia de Tiendas
  $listaArticulos=$tiendas->obtener_Articulos($categoria);// invocamos el metodo obtener_Tiendas pasandole el tipo de tienda a buscar cual lo que hace es 
  
 
$numero=count($listaArticulos); // obtenemos el numero de registros en el arrays
  $nombre=$tiendas->obtener_Nombre_Categoria($categoria); 
  $array_para_enviar_via_url_2 = serialize($nombre);
  $array_para_enviar_via_url_2 = urlencode($array_para_enviar_via_url_2);
if ("$numero">=1)   {
    
      //  $nombre=("Viveres");
      
      
      
       
       $array_para_enviar_via_url = serialize($listaArticulos);
       // urlencode es opcional no es obligatoria pero usamos para la buena codificacion en caso de caracteres especiales     
       $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
       
         // y enviamos a la pagina junto con el nombre del tipo de tienda 
        header("Location:../tiendasPublico.php?nombre=$array_para_enviar_via_url_2&id=$categoria&matriz=$array_para_enviar_via_url");  
     }
      else {
       
     
         // header('Location:' . getenv('HTTP_REFERER'));
         
           header("Location:../tiendasPublico.php?nombre=$array_para_enviar_via_url_2&id=$categoria&error");  
      } 
?>
