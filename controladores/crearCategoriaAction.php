<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo damasCatalogo.php
  
  
 

 $nombre=$_POST[nombre];
 $carga=$_POST[carga];  // balor booleano que indica si la foto fue cargada correctamente


  $tienda=new Tiendas();    // creamos una instancia o un objeto de la clase Tiendas  , que se encuentra en la carpeta modelo 
  $respuesta=$tienda->crear_Categoria($nombre);// invocamos el metodo crear_Categoria pasandole la categoria a registrar
  
 
  
  if ($respuesta = 'TRUE')
  
      {
    // y enviamos a la pagina
      header("location:../crearCategoria.php?respuesta=$respuesta");
      
  }
  else {
      header("location:../crearCategoriaPaso2.php?error");
  }
  
       
      
      
     
     

  
  
  ?>
   
