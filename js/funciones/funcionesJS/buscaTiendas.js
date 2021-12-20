$(document).ready(function(){
    //alert("aqui");
    
 //  ******** metodo para hacer la peticion asincrona ********   
   
   //si quisieramos pasar mas de un parametro
   // var getdetails = function(valor,valor2){ 
   
    var listaTiendas = function(valor){
        // utilizamos el metodo de ajax $.getJSON  
        return $.getJSON( "buscarTiendas.php",
        { "id" : valor },
     // { "id2" : valor2 }    pudiesemos pasar otro parametro    
                
      );
    }
    
  // *******************************************************************  
    
  // al hacer clip sobre el boton del formulario que tiene el id boton tienda 
   //damos a la variable $id el valor que contenga el select de nombre tipoTienda
 
    $('#botonTienda').click(function(e){
        $id=($('select[name=tiposTienda]').val()); 
        
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        
        //Mostramos texto de que la solicitud está en curso
        $("#response-container").html("<p>Buscando...</p>");
        
       // invocamos el metodo lista tienda el cual nos traera el objet Json de la base de datos
       // el cual se llamara $tienda
        $tiendas=listaTiendas($id)
        
        // hacemos uso del atributo done de todo objet JSON para crear la funcion que nos modificara la vista
        // o sea el html
        $tiendas.done( function( response ) {
           
            if( response.success ) {
               
            //alert($id);
               
                var output = "<h1>" + response.data.message + "</h1>";
                //recorremos cada usuario
                $.each(response.data.tiendas, function( key, value ) {
                    output += "<div><img border=\"0\" src=\"imagenes/tiendas/" + value['id_Tienda'] + ".jpg\"  ></div>";
                    output += "<div>id : " + value['id_Tienda'] + "</div>";
                    output += "<h3>Nombre : " + value['nombre_Tienda'] + "</h3>";
                    output += "<div>Ubicacion :  " + value['direccion_Tienda'] + "</div>";
                    
                    //recorremos los valores de cada tienda
                   
                });
                
                //Actualizamos el HTML del elemento con id="#response-container"
                $("#response-container").html(output);
        
            
            
            }
                
            
            
            else {
                //response.success no es true
                $("#response-container").html('No ha habido suerte: ' + response.data.message);
                
              
                
                
                
                
                
                
                
                
                
                
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            $("#response-container").html("Algo ha fallado: " +  textStatus);
        });
    });
});        