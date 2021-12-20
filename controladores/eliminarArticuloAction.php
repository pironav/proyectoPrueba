<?php
  
  require '../modelo/tiendas_M.php';       // incluimos el archivo articulo_M.php.php
  
  
 $id=$_GET[id];  // obtenemos id del articulo a eliminar 
 $nombre=$_GET[nombre];
 
 
  $tienda=new Tiendas();   
  $respuesta=$tienda->eliminar_Articulo($id);
 
  if ("$respuesta">=1)   {
            
       
      
       header("Location:../verArticuloAdmin.php");
        
        }
      else {
         header("Location:../verArticuloAdmin.php?error");  
      } 
     
      
  ?>
   