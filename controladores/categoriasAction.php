<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo Tiendas_M.php
 
 
 
  $tiendas=new Tiendas();    // creamos una instancia de Tiendas
  $listaCategorias=$tiendas->obtener_Categorias();// invocamos el metodo obtener_Tiendas pasandole el tipo de tienda a buscar cual lo que hace es 
  
 
$numero=count($listaCategorias); // obtenemos el numero de registros en el arrays
 
 
if ("$numero">=1)   {
    
      //  $nombre=("Viveres");
      
      
      
       
        $array_para_enviar_via_url = serialize($listaCategorias);
       // urlencode es opcional no es obligatoria pero usamos para la buena codificacion en caso de caracteres especiales     
       $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
       
         // y enviamos a la pagina junto con el nombre del tipo de tienda 
        header("Location:../categoriaTiendasAdmin.php?&matriz=$array_para_enviar_via_url");  
     }
      else {
       
     
         // header('Location:' . getenv('HTTP_REFERER'));
         
           header("Location:../categoriaTiendasAdmin.php?&error");  
      } 
?>
