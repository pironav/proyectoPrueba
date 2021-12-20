<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="UTF-8">
  <title>Tu Bodeguita</title>
  <link rel="shortcut icon" href="carritoFavicon.ico" >
  <link rel="stylesheet" href="css/index.css"> 
  <script src="js/libreriaJS.js"></script> 
  <script src="js/libreriaJqueyyAjax.js"></script>
  <script src="js/funciones/funcionesPHP/cargador.php"></script> 
   <!-- libreria swettalert2 para mensajes tipo modal emergentes-->
   
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#276955"> <!-- para cambiar color a la barra del navegador google crome -->
   
 </head> 
 <script language="javascript">
 function validar()    {
          
     if  (document.forms[0].elements["tipoTienda"].value == "")
         {
            alert("seleccione una tienda");
            ok = true;
            return false;
          }                           
}

</script>
<script>
 $(document).ready(main);
        
  function main () {
	$('').click(function(){
	alert("ok");	
	}
                );
 
        
        
}
</script>

 
<body>
  
<?php include("plantillaHeader.php"); ?>  <!-- Importamos el Header -->       
<main>
    <div class="container">
       <div class="aside">
           <div class="selector">
              <span>CATEGORIAS</span>
                        <?php
                             require_once("js/funciones/funcionesPHP/cargador.php");
                             $miArray= categoriasTienda();
                             //  imprime todo el arrays 
                           //  echo "<pre>";
                            //  print_r($miArray);
                           //    echo "</pre>";
                          ?>
              <form action="controladores/catalogoArticulosPublicoAction.php"  method="get" >
                  <select name="categoria" >
                              <option value="">Selecione</option>
                              <?php foreach ($miArray as $categorias): ?> 
                              <option  class="selecTipo" value="<?php echo $categorias[id_Categoria] ?>"><?php echo $categorias[nombre_Categoria] ?></option>
                              <?php endforeach; ?>  
                         </select>
                        
                         <button  id="botonTienda"><img border="0" src="css/imagenes-svg/lupaBlanca.svg" width="30" height="20" title="Buscar" ></button>
            </form>  
           </div>
           
          
           
            
       </div> 
        <div id="categoriaNombre">
             <span></span>
        </div> 
        <div class="categorias">
            <?php foreach ($miArray as $categorias): ?> 
                 <div class="contenedorTiendas">
                      <div>
                          <a href="controladores/catalogoArticulosPublicoAction.php?categoria=<?php echo $categorias['id_Categoria']?>"><img border="0" src="imagenes/categorias/<?php echo $categorias['id_Categoria']?>.jpg"  title="viveres"></a>
                         <span><?php echo $categorias['nombre_Categoria']?></span>
                          
                      </div> 
                 </div>
            <?php endforeach; ?>
           
           
           
         </div>
        <article>
             
           
            
           
        </article>    
         
        </div>
     
   
           
        
   
</main>

 <footer>
      <?php include("plantillaFooter.php"); ?>  <!-- Importamos el Footer --> 
 </footer>
</body>

</html>