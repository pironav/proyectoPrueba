<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo damasCatalogo.php
  
  
 $nombreCategoria=$_POST[nombreCategoria];
 $idCategoria=$_POST[idCategoria];
 $categoria=$_POST[idCategoria];
 $nombre=$_POST[nombre]; // nombreArticulo
 $precio=$_POST[precio];
 $descripcion=$_POST[textarea];
 
 $carga=$_POST[carga];  // valor booleano que indica si la foto fue cargada correctamente

 
  $tienda=new Tiendas();    // creamos una instancia o un objeto de la clase Tiendas  , que se encuentra en la carpeta modelo 
  $respuesta=$tienda->crear_Articulo($categoria,$nombre,$precio,$descripcion);// invocamos el metodo crear_Categoria pasandole la categoria a registrar
  
 
  
  if ($respuesta = 'TRUE')
  
      {
    // y enviamos a la pagina
      header("location:../crearArticulo.php?respuesta=$respuesta&nombreCategoria=$nombreCategoria&idCategoria=$idCategoria");
      
  }
  else {
      header("location:../crearArticuloPaso2.php?error");
  }
  
       
      
      
     
     

  
  
  ?>
   
