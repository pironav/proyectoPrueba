<?php
  require '../modelo/tiendas_M.php';       // incluimos el archivo damasCatalogo.php
  
 $idCat=$_POST['idCategoria']; 
 $nombreCat=$_POST['categoria'];
 $idArt=$_POST['idArticulo']; 

 $nombreArt=$_POST['nombre'];
 $precio=$_POST['precio']; 
 $descripcion=$_POST['textarea'];
 
 $carga=$_POST[carga];  // valor booleano que indica si la foto fue cargada correctamente
 

  $tienda=new Tiendas();    // creamos una instancia o un objeto de la clase Tiendas  , que se encuentra en la carpeta modelo 
  $editar=$tienda->editar_Articulo($idArt,$idCat,$nombreArt,$precio,$descripcion);// invocamos el metodo editar_Categoria pasandole la categoria a registrar
  
  if ($editar = 1)
      
      {
      $respuesta = 'TRUE';
     
      header("location:../editarArticulo.php?respuesta=$respuesta&nombreCategoria=$nombreCat&nombre=$nombreArt&precio=$precio&descripcion=$descripcion&id=$idArt&idCategoria=$idCat");
      
  }
  else {
      // regresar a la pagina anterior con el mensaje no se pudieron realizar los cambios
      // ojo no enviar los datos recibidos aqui si por un supuesto no se realizo la modificacion
      // el formulario debe cargar con sus datos originales
      header("location:../editarArticulo.php?error");
  }
  
       
      
      
     
     

  
  
  ?>
   
