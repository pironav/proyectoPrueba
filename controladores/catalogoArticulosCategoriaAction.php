<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo Tiendas_M.php
  $id=$_GET[id];  // obtenemos el id de la categoria 
  $categoria=$_GET[nombreCategoria]; 
 
  $tiendas=new Tiendas();    // creamos una instancia de Tiendas
  $listaCategorias=$tiendas->obtener_Categorias();// invocamos el metodo obtener_Tiendas pasandole el tipo de tienda a buscar cual lo que hace es 
  $numero=count($listaCategorias); // obtenemos el numero de registros en el arrays
  $listaArticulos=$tiendas->obtener_Articulos($id);// invocamos el metodo obtener_Tiendas pasandole el tipo de tienda a buscar cual lo que hace es 
  $numero2=count($listaArticulos); // obtenemos el numero de registros en el arrays
  $array_para_enviar_via_url = serialize($listaCategorias);
       // urlencode es opcional no es obligatoria pero usamos para la buena codificacion en caso de caracteres especiales     
       $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
if  ($numero2 >= 1)   {
    
      
       
       
       $array_para_enviar_via_url_2 = serialize($listaArticulos);
       // urlencode es opcional no es obligatoria pero usamos para la buena codificacion en caso de caracteres especiales     
       $array_para_enviar_via_url_2 = urlencode($array_para_enviar_via_url_2);
       
         // y enviamos a la pagina junto con el nombre del tipo de tienda 
        header("Location:../articulosCategoriasAdmin.php?matriz=$array_para_enviar_via_url&matriz2=$array_para_enviar_via_url_2&nombreCategoria=$categoria&idCategoria=$id");  
     }
      else {
       
     
         // header('Location:' . getenv('HTTP_REFERER'));
         
           header("Location:../articulosCategoriasAdmin.php?matriz=$array_para_enviar_via_url&nombreCategoria=$categoria&idCategoria=$id&error");  
      } 
?>
