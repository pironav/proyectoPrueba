<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo damasCatalogo.php
  
 $id=$_GET['id']; 
 $nombre=$_POST[nombre];
 $carga=$_POST[carga];  // valor booleano que indica si la foto fue cargada correctamente


  $tienda=new Tiendas();    // creamos una instancia o un objeto de la clase Tiendas  , que se encuentra en la carpeta modelo 
  $respuesta=$tienda->editar_Categoria($nombre,$id);// invocamos el metodo editar_Categoria pasandole la categoria a registrar
  
  if ($respuesta = 'TRUE')
  
      {
     // obtenemos de nuevo el nombre de la categoria pos si acaso se modifico 
     $nuevoNombre=$tienda->obtener_Nombre_Categoria($id);
    // y enviamos a la pagina
      header("location:../editarCategoria.php?id=$id&respuesta=$respuesta&categoria=$nuevoNombre");
      
  }
  else {
      header("location:../editarCategoriaPaso2.php?error");
  }
  
       
      
      
     
     

  
  
  ?>
   
