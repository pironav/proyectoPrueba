<?php
   session_start();   // crea o reanuda una sesion
   
   if (!isset($_SESSION["usuario"]))  // si no hay nada en la variable superglobal llamada usuario (ver el signo !)
        {
          header("location: loginAdministrador.php?error");  // que nos redirija a la pagina index
        }
    
?>
<!-- ************* comprobacion de inicio de session hacer en todas las paginas  *********************** -->      
<!-- y si no continua su flujo normal esto evita entrar por el browser colocando la direccion de la pagina, evitando ser hakeado
no dejar espacios entre ?php y la primera linea igual al final entre ?> y la ultima line porque sino en el servidor no corre
*****************************************************************************************************-->         
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tu Bodeguita</title>
        <link rel="shortcut icon" href="carritoFavicon.ico" >
        <link rel="stylesheet" href="css/plantillaAdmin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/sweetalert2.js"></script> 
        
</head>


<script language="javascript">
            //funcion para mostrar mensaje de alerta para confirmar si se 
            //elimina un articulo

            function mensajeEliminar($id)
            {
                Swal.fire({
  title: 'Esta ud Seguro?',
  text: "Esta accion eliminara esta categoria y todos los Articulos registrados con esta categoria",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: 'Si , Eliminar!'
}).then((result) => {
  if (result.value) {
     
   window.location = 'controladores/eliminarCategoriaAction.php?id='+$id;    
  }
})
}

</script>



<style>
#contenedor {
   

 display: flex;
 margin: 0px 8px 0px 8px;
 justify-content:center;
 align-items: center;
 
 
    
}

#contenedor .categoria {
    border-radius: 15px;
    background: #FFF;
    display: flex;
    flex-direction: column;
    flex-basis: 300px;
    max-width: 310px;
    min-width: 310px;
    min-height:350px;
    flex-grow: 1;
    justify-content: flex-start;
    align-items: center;
     border-style: solid;
     border-width: 1px;
     border-color: #8f9591;
}
#contenedor .cabecera {
   width: 100%;
   padding: 5px 0px 5px 0px;
   display: flex;
    align-items: center;
     border-style: solid;
     border-width: 0px 0px 1px 0px;
     border-color: #8f9591;
     font-size: 1.3em;
    
}   

#contenedor .cabecera .volver {
    width: 10%;
    margin-top: 2px;
    margin-left: 10px;
   text-align: center;
    display: flex;
    justify-content: flex-start;
      
}

#contenedor  .cabecera .volver .boton {
  border-radius: 50%;
   background:#FFF;
  min-height: 40px;
  min-width: 40px;
  display: flex;
  justify-content: center;
  align-items: center;   
}

#contenedor .cabecera .volver .boton:hover{
 background: #d8f0e1;
font-size: 1.3em;
 
}

#contenedor .cabecera .etiqueta{
width: 90%;    
padding-right: 10%; 

text-align: center;
}


#contenedor .categoria .nombre {
   margin-top: 20px;
   
   width: 100%;
   padding: 5px 0px 5px 0px;
   display: flex;
   justify-content: center;
    align-items: center;
    font-size: 1.3em; 
}

#contenedor .categoria .imagen {
   
   margin-top: 20px;
   display: flex;  /* de esta manera con estas tres instruciones hacemos*/
   flex-direction: column;  /* que cualquier div tome el ancho y largo del contenido*/
   width: 100%; 
   align-items: center;
}

#contenedor .categoria .imagen img{  /* y aqui decimos que la imagen ocupe el 50% del contenedor */
 width: 50%;   
 height: auto;   
}



 


@media screen and (max-width: 750px) { /*igual que el menu header siempre */

 .footer{     /*ocultamos el footer*/
        display: none;
    }



}


</style>



       

<body>
 <script> 
function chekingUsuario($url,$nivel){ 
// declarar despues del body esta funcion         
       // alert($nivel); 
        if ($nivel===1)
        {
        //  alert($nivel); 
         location.href =$url;  
        }
        else {
         Swal.fire({
   width: 300, 
   height:270,
  position: 'center',
  icon: 'error',
  
  title: 'Modulo Restringido',
  text: "Solo Usuarios Autorizados",//agrega texto aqui
  type: 'success',
      // para mensaje de error cambiar por la linea de abajo
      //type: 'error',
  confirmButtonColor: '#3085d6',
  showConfirmButton: true
  
  
})
         
        }
   	
      
} 
</script>    
	 <?php include("plantillaHeaderAdmin.php"); ?>  <!-- Importamos el Header -->     
       <div class="container">
           <div id="apartado">
               <p><a href="inicioAdministrador.php">Mi Tienda</a></p>&nbsp><p style="color:#000000">Categorias</p> 
                     </div>
           
           <div class="main">
                <div class="baner">
                     
                </div>
                 <div class="areaTrabajo">
                     <div class="franjaMenu">
                
               <div id="menuSecundario">
                            <nav>
                                <ul>
                                   
                                    <li><a href="editarCategoria.php?categoria=<?php echo $_GET['categoria']?>&id=<?php echo $_GET['id']?>"><span class="link"><img border="0" src="css/imagenes-svg/editar.svg" width="15" height="15" title="Editar Categoria"><p>Editar</p></span></a></li>
                                     <li><a href="#" id="" onclick=" return mensajeEliminar('<?php echo$_GET['id']?>')"><span class="link"><img border="0" src="css/imagenes-svg/papelera2.svg" width="15" height="15" title="Eliminar articulo"><p>Eliminar</p></span></a></li>
                                </ul>
	                     </nav>
                 </div>  
                  
              </div>
                     
                     <div id="contenedor">
                         <div class="categoria">
                             <div class="cabecera">
                                 <div class="volver">
                                     <div class="boton"><a href="javascript:history.back(-1);"><img src="css/imagenes-svg/flecha-izquierda.svg" width="30"> </a></div>
                                 </div> 
                                <div class="etiqueta">
                                   <span>Categoria</span>
                                </div>    
                             </div>
                             <div class="nombre"><?php echo $_GET['categoria']?></div>    
                             <div class="imagen"><img src="imagenes/categorias/<?php echo $_GET['id']?>.jpg"></div>
                         </div>
                        
                        
                         
                     </div>
                      
                </div>
                     
                     
                </div>  
          </div>
       </div>     
              
         
           
                       
                    
             
</body>
</html>