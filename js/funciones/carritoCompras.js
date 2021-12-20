

// script para el manejo, presentacion y edicion del carrito de compras
// **********************************************************************//
// 
// 

//  este scrip es el unico que no es llamado como  funcion es como un objeto que esta escuchando cuando se de clip en el
// icono del carrito para mostrar el contenido del carrito,y entonces si se ejecuta la funcion ver carrito un clip lo abre y con otro lo cierra
$(document).ready(verCarrito); // poner el mismo nombre de la funcion
var condicion = 1; // se establece en 1 = cerrado ojo el carrito  la actualizamos en la funcion cerrar carrito
function verCarrito () {
        
	$('#iconoCarrito').click(function(){
		if (condicion === 1) {
			$('#container').animate({width: '500px'});
			condicion=0;
                       // alert(contador);
		     } 
                else 
                    {
                         $('#container').animate({width: '0px'});
                         condicion=1;
                        // alert(contador);
		   }
             }
                );
  // al hacer clip en cualquier parte fuera del menu este se cerrara 
 // pero debemos asegurarnos que haya un div general llamado main en la pa
 // gina donde llamemos al  a esta pagina
       /*  $('.catalogo').click(function(){
		$('#container').animate({width: '0px'});	
	        condicion = 1;
		}
                );    */            
}



  // esta funcion es llamada por la funcion agregarArticulo()
  // basicamente chequea si el articulo que se va a agregar ya existe en el carrito
  // para no volverlo agregar, si existe nos devuelve la fila donde esta
  // para luego en la funcion que la llama modificar el campo cantidad o en su defecto agregar un articulo nuevo
  function chequearTabla(id){
  //alert("aqui"); 
  var table = document.getElementById("tablaCarritoCompras");
  var contadorFilas = table.rows.length;
  fila=contadorFilas-1;
  // alert("filas encontrada en carrito son: "+fila);
  if (contadorFilas === 1) // valor 1 indica que la tabla esta vacia el 1 corresponde a la fila cabezera
    {
      encontrado = 0; // no hay fila donde se pueda encontrar coincidencia con el id recibido
    }
  else
  {
     cont=contadorFilas-1; // cantidad de filas (articulos) existentes en tabla
    // alert("contador es"+cont);
     encontrado=0;
     id2=0;
     i=1;
     while (cont > 0 && encontrado === 0 )  
     {
        id2 = table.rows[i].cells[0].innerText;// comparamos id recibido con id de tabla
       // alert("id encontrado en tabla es"+id2+"e id a buscar es"+id);
        if (id == id2)
           {
              encontrado = i;// fila a modificar
            }
        ++i;
        --cont;   
   }
  }
  return encontrado; 
 }


 // esta es la funcion que agrega articulos al carrito
 function agregarArticulo(id,nombre,precio){
  //chequeamos si el articulo ya esta ingresado al carrito 
  precioEntero=parseFloat(precio,10);
  var filaArticulo = chequearTabla(id); 
  //ert("fila devuelta en funcion es: "+filaArticulo);
  if (filaArticulo === 0)// si articulo no esta en carrito lo agregamos
    {
      var table = document.getElementById("tablaCarritoCompras");
      cantidad=1;    
      subTotal = precioEntero * cantidad;  
     table.insertRow(-1).innerHTML = '<td class="campo" hidden="true">'+id+'</td><td class="campo">'+cantidad+'</td><td class="campo">'+nombre+'</td><td class="campo">'+precio+'</td><td class="campo">'+subTotal+'</td><td class = "operador" onclick="sumaArticulo('+id+')" ><img border="0" src="css/imagenes-svg/suma.svg" width="10" height="10" title="Agrega un Articulo"></td><td class = "operador" onclick="restaArticulo('+id+')" ><img border="0" src="css/imagenes-svg/resta.svg" width="10" height="10" title="Resta un Articulo"></td><td class = "operador" onclick="eliminarArticulo('+id+')" ><img border="0" src="css/imagenes-svg/papelera2.svg" width="15" height="15" title="Eliminar Articulo actual"></td>';
     
     
  }
  // aqui agregamos o sumamos los campos cantidad y total si el articulo ya existe en carrito
  else {
    i=filaArticulo; 
    var table = document.getElementById("tablaCarritoCompras");   
    cantidad = table.rows[i].cells[1].innerText; 
    //alert("cantidad es "+cantidad);
    ++cantidad;
    subTotal = precioEntero * cantidad; 
    table.rows[i].cells[1].innerHTML = cantidad ;
    table.rows[i].cells[4].innerHTML = subTotal ;
    
  }
  //quitamos la imagen del carrito vacio
  var carroVacio = document.getElementById('carroVacio');
  carroVacio.style.display = 'none';
 
 
  totalCarrito(0);// llamada a funcion
  
}

// aqui sumamos todos los montos qe todos los articulos que estan en el carrito
// tambien sumamos e impriminos todos los Articulos
function totalCarrito(int){
const recargandoPagina = int; // si 0 es que no estamos recargando o entrando de nuevo a la pagina caso 1 si
var table = document.getElementById("tablaCarritoCompras");
var contFilas = table.rows.length;
cont=contFilas;
//alert(cont);
i=1;
suma=0;// suma de los precios de cada articulo
suma2=0;// suma de la cantidad de articulos en el carrito
var preciosTotal = document.getElementById("sumaTotal");// el div donde esta la suma
var articulosTotal = document.getElementById("totalArticulos");// el div donde esta la suma
var iconoCarritoTotal = document.getElementById("numero");
if (contFilas===1) 
  {
    preciosTotal.innerHTML = "";
    articulosTotal.innerHTML = "";
    iconoCarritoTotal.innerHTML = "";    
   } 
else {
      // quitamos la imagen del carrito vacio de la tabla
      var carroVacio = document.getElementById('carroVacio');
      carroVacio.style.display = 'none';
     }
while (cont > 1 )  
      
     {
         
        //valor=5;
        valor=table.rows[i].cells[4].innerText;// precio articulo
        
       //alor=parseFloat(precio,10);// tomamo solo la parte entera eliminamos caracteres de $ o Bs
        
        valor2=table.rows[i].cells[1].innerText;// cantidad de articulos
        valor=parseInt(valor,10);
        valor2=parseInt(valor2,10);
        suma=suma+valor; 
         suma2=suma2+valor2; 
       //alert("suma total es "+suma);
        ++i;
        --cont; 
        // hay que imprimir valor en div desde aqui ya que la variable valor da un tipo de dato NaM
        // que no permite pasarlo por return para ser recibido  en una llamada de funcionla funcion
       // corregir luego
       
       preciosTotal.innerHTML = suma ; 
       
      
       articulosTotal.innerHTML = suma2; 
      
       iconoCarritoTotal.innerHTML=suma2;
       if (recargandoPagina === 0)  // no se esta recargando pagina por tanto no necesitamos actualizar sesion
       {
         actualizarCarritoSesion();   
       }
      
       }  
      
   
  } 
 
 
// aqui enviamos el array a la pagina hp que actualizara la variable de sesion carrito
// recordemos que por el tema lado del cliente no podriamos hacerlo por tanto mandamos hacerlo 
// del lado del servidor
function actualizarCarritoSesion(valor){
valor_a_Enviar ="null";     
if (valor === 0) 
    {
    valor_a_Enviar = valor; 
    }
else 
    {
       miArray=crearArrayTabla(); 
       //alert("probando ; array 0,2 y es"+miArray[0][2]);
       //alert(miArray[0][2]);
       //   ********* Creamos objeto JSON con el array para poder ser enviado 
       //serializamos el array para poderlo enviat por el metodo get del objeto XMLHTTP
        miarraySerializado=JSON.stringify(miArray);
        valor = miarraySerializado;
    }
//creamos el objeto  xmlhttp de AJAX que nos va permitir hacer la transferencia de datos 
//entre el cliente y la pagina php que esta en el servidor
xmlhttp=new XMLHttpRequest();
console.log("el valor a pasar para actualizar sesion es "+valor);
xmlhttp.open("GET"," sesionCarrito.php?arrayCarrito="+valor);
xmlhttp.send();
efectoGuardado();

}
// esta funcion hace un efecto visual en el icono del carrito
//como para que el usuario vea que se modificoel carrito carrito
// ya sea porque se agregaron o quitaron articulos del carrito
function efectoGuardado() {
   // alert("aqui");
    var div = document.getElementById('iconoCarrito');
    div.style.width = '60px';
    div.style.height = '60px';
    div.style.background= '#F5B041';
// luego con set time le decimos que luego de 800 milisegundos retome sus valores normales    
    setTimeout(function(){
    div.style.width = '45px';
    div.style.height = '45px';
    div.style.background= '#FFF'; }, 800);
    
}
 

// eliminamos un articulo del carrito y actualizamos suma total de el monto de los articulos
function eliminarArticulo(id){
  var table = document.getElementById("tablaCarritoCompras");
  var nroFilas = table.rows.length;
  var auxNroFilas = nroFilas;
  //alert(nroFilas);
 
  encontrado=0; 
   i=1;  
   while (nroFilas > 0 && encontrado === 0 )  
     {
        id2 = table.rows[i].cells[0].innerText;// comparamos id recibido con id de tabla
       // alert("id encontrado en tabla es"+id2+"e id a buscar es"+id);
        if (id == id2)
           {
              encontrado = i;// fila a modificar
              table.deleteRow(i);
            }
        ++i;
        --nroFilas; 
       
   } 
   
  var ahoraFilas = table.rows.length; // chequeamos cuantos articulos hay despues de eliminar este ultimo
  if(ahoraFilas === 1)
     {
      var carroVacio = document.getElementById('carroVacio');
      carroVacio.style.display = 'flex';
     }
      
    if (auxNroFilas === 2)  // si 2 quiere decir solo tenemos un registro mas la cabezera de la tabla
     {
      preciosTotal.innerHTML = suma ; // el div donde esta la suma    
      var articulosTotal = document.getElementById("totalArticulos");// el div donde esta la suma   
      var iconoCarritoTotal = document.getElementById("numero"); 
      divTotal.innerHTML = "" ;
      articulosTotal.innerHTML = "" ; 
      iconoCarritoTotal.innerHTML = "" ; 
      actualizarCarritoSesion(0); 
     }
  else {
   totalCarrito(0);    
     } 
     
  //return encontrado; 
}

// aqui vaciamos por completo el carrito y hacemos suma total de los mostos(precios) 0 0       
function vaciarCarrito(){
  var divTotal = document.getElementById("sumaTotal");// el div donde esta la suma 
  var articulosTotal = document.getElementById("totalArticulos");// el div donde esta la suma
  var iconoCarritoTotal = document.getElementById("numero");
  var myTable = document.getElementById("tablaCarritoCompras"); 
  var rowCount = myTable.rows.length; 
  for (var x=rowCount-1; x>0; x--) { 
      myTable.deleteRow(x); 
  } 
   divTotal.innerHTML = "" ; 
   articulosTotal.innerHTML = "" ; 
   iconoCarritoTotal.innerHTML = "" ; 
   var carroVacio = document.getElementById('carroVacio');
   carroVacio.style.display = 'flex'; // hacemos visible la imagen del carrito vacio
   actualizarCarritoSesion(0);// enviamos 0 para indicrle al metodo que el carrito esta vacio ahora


}   

// se actualiza la suma de los montos(precios) del carrito, luego de eliminar o sumar  un articulo del carrito
  function ActualizarSumaCarrito(){
  var divTotal = document.getElementById("sumaTotal");// el div donde esta la suma  
  var myTable = document.getElementById("tablaCarritoCompras"); 
  var rowCount = myTable.rows.length; 
  for (var x=rowCount-1; x>0; x--) { 
      myTable.deleteRow(x); 
  } 
   divTotal.innerHTML = "" ; 
} 

// Aumenta cantidad en uno a un articuo ya agregado al carrito modifica una fia en cabtidad de
//articulos y subtotal y luego calcula el totaa de todo el carrito e imprime
 function sumaArticulo(id){
    
  var filaArticulo = chequearTabla(id);   
  i=filaArticulo; 
  var table = document.getElementById("tablaCarritoCompras");   
  cantidad = table.rows[i].cells[1].innerText; 
  precio = table.rows[i].cells[3].innerText;
  precio=parseFloat(precio,10);
  
    ++cantidad;
    subTotal = precio * cantidad; 
    subTotal = subTotal.toFixed(2); 
    table.rows[i].cells[1].innerHTML = cantidad ;
    table.rows[i].cells[4].innerHTML = subTotal ;
    totalCarrito(0);
}  



//disminuye en 1 el campo cantidad de un articulo ya agregado en el carrito
function restaArticulo(id){
  var filaArticulo = chequearTabla(id);   
  i=filaArticulo; 
  var table = document.getElementById("tablaCarritoCompras");   
  cantidad = table.rows[i].cells[1].innerText; 
  precio = table.rows[i].cells[3].innerText; 
  precio=parseFloat(precio,10);// quitamos letras en caso de haber como $ o Bs
   if (cantidad > 1)
   {
    --cantidad;
    subTotal = precio * cantidad; 
    table.rows[i].cells[1].innerHTML = cantidad ;
    table.rows[i].cells[4].innerHTML = subTotal ;
    totalCarrito(0);
    }
} 


// cerramos el carrito desde el icono X de cerrar ventana 
 function cerrarCarrito() {
      
    // alert("aqui");
        var contador = 1;
	
           if (contador === 1) {
                        // alert(contador);
			$('#container').animate({
		          width: '0px'
                        });
			contador=0;
		        } 
  condicion=1;              
}


// creamos uu arreglo bidireccional con la tala , de forma de guardarlo en una variable de sesion 
//e forma tal que se pueda rescatar esos datos y si se actualiza la pagina o se cambia de pagina
// al regresar se pueda con esos datos volver a llenar el carrito  

 

 

function crearArrayTabla() {
      // alert("aqui");
var table = document.getElementById("tablaCarritoCompras");
var contFilas = table.rows.length-1;
 
//alert(contFilas);
var columnas = 4; //cantidad de columnas de la tabla que deseamos muestre
//alert(contFilas);
var i = 0;
let miArray = [];
for (let i = 0; i < contFilas; i++) {
  miArray[i] = new Array(contFilas);
  for (let j = 0; j < columnas ; j++) {
    //miArray[i][j] = '[' + i + ', ' + j + ']';
    
    miArray[i][j] = table.rows[i+1].cells[j].innerText; //i+1 para evitar cabezera tabla
   //alert("es"+miArray[i][j]);
   console.log(i+","+j+":"+miArray[i][j]);//ver por la consola del navegador
   }
 }
return miArray;
}

// rescatamos los datos que estan en la variable de sesion $_SESION[carrito]
// para luego con ellos volvera llenar el carrito cuando hayamos salido de la pagina
// y estemos regresando nuevamente
 function rellenarCarrito(){

var xmlhttp;
var contenidosRecibidos = new Array();
// objeto de ajax que instanciamos para poder hacer la transferencia de datos
xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {  // la funcion que se ejecutara al hacer la peticion
  if (xmlhttp.readyState===4 && xmlhttp.status===200) {
    contenidosRecibidos = xmlhttp.responseText;
   // alert("rellenar carrito"+contenidosRecibidos);
    miArrayDeserializado=JSON.parse(contenidosRecibidos); //dessserializamos el objeto JSON
    console.log(miArrayDeserializado[0][2]);
    //document.getElementById("txtInformacion").innerHTML=contenidosRecibidos[0];
    ReagregarArticulos(miArrayDeserializado);
   
    }
};
xmlhttp.open("GET","dameSesionCarrito.php");
xmlhttp.send();


}
// con el array que contiene los datos almacenados en la variable de sesion $_SESION[carrito]
//volvemos a llenar el carrito
function ReagregarArticulos(miArray){
   
  
  var table = document.getElementById("tablaCarritoCompras");
  nroRegistros=miArray.length;
  columnas=4;
  //alert (miArray[0][2]);
  i=0;
  for (i = 0; i < nroRegistros; i++) {
       id=miArray[i][0];
       cantidad=miArray[i][1];
       nombre=miArray[i][2];
       precio=miArray[i][3];
       precioEntero=parseFloat(precio,10);
       subTotal = precioEntero * cantidad;   
 // ojo debe ser exactamente igual al llenado en carrito 1, si se modifica alla modificar aqui y viceversa      
      table.insertRow(-1).innerHTML = '<td class="campo" hidden="true">'+id+'</td><td class="campo">'+cantidad+'</td><td class="campo">'+nombre+'</td><td class="campo">'+precio+'</td><td class="campo">'+subTotal+'</td><td class = "operador" onclick="sumaArticulo('+id+')" ><img border="0" src="css/imagenes-svg/suma.svg" width="10" height="10" title="Agrega un Articulo"></td><td class = "operador" onclick="restaArticulo('+id+')" ><img border="0" src="css/imagenes-svg/resta.svg" width="10" height="10" title="Resta un Articulo"></td><td class = "operador" onclick="eliminarArticulo('+id+')" ><img border="0" src="css/imagenes-svg/papelera2.svg" width="15" height="15" title="Eliminar Articulo actual"></td>';

}
totalCarrito(1);// llamada a funcion
  
}
// agregamos un articulo desde la ventana modal, la cual nos indica la posicion del articulo en la lista desplegada en la pagina
function agregarArticuloPosicion(){
 // obtenemos la posicion desde la ventana modal   
 var posicion = document.querySelector("#miModal .modal-contenido #modalPosiciónArticulo").innerText;
 //alert(posicion);  
 // obtenemos luego los valores id nombre y precio desde el listado de productos segun la posicion ya encontrad 
 var ids = document.querySelectorAll(".articulo .informacion #idArticulo");// obtenemos una lista de id
 id=ids[posicion-1].innerText; //accedemos al id del articulo en ña posicion indicada
 
 var nombres = document.querySelectorAll(".articulo .informacion #nombreArticulo");// obtenemos una lista de nombres
 nombre=nombres[posicion-1].innerText; //accedemos al nombre del articulo en ña posicion = valor-1
 
 var precios = document.querySelectorAll(".articulo .informacion #precio"); //obtenemos una lista de precios
 precio=precios[posicion-1].innerText; //accedemos al precio del articulo en ña posicion = valor-1           
 var ventana = document.querySelector("#miModal .modal-contenido #modalTapa a");
 ventana.click();
 
 agregarArticulo(id,nombre,precio);  // agregamos el articulo
 (".articulo #botonCarrito"); //obtenemos una lista de precios

 
document.querySelector(".articulo #botonCarrito")[posicion-1].focus(); //obtenemos una lista de precios

 

 
  
}


 


 
