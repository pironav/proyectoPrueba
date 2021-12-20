<?php
  
  require '../modelo/tiendas_M.php';       // incluimos el archivo articulo_M.php.php
  
  
 $id=$_GET[id];  // obtenemos de la id de la categoria a eliminar 

 
 
  $tienda=new Tiendas();   
  $respuesta=$tienda->eliminar_Categoria($id);
 
  if ("$respuesta">=1)   {
            
       
      
       header("Location:../controladores/categoriasAction.php");
        
        }
      else {
         header("Location:../controladores/categoriaAction.php");  
      } 
     
      
  ?>
   