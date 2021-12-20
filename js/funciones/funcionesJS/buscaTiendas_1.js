$(document).ready(function(){
    //alert("aqui");
    

    
  // al hacer clip sobre el boton del formulario que tiene el id boton tienda 
   //damos a la variable $id el valor que contenga el select de nombre tipoTienda
 
    $('#botonTienda').click(function(e){
        $id=($('select[name=tiposTienda]').val()); 
        
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        
        window.location.href = "controladores/tiendas.php";
      
      
    });
});        