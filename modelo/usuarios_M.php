<?php
	
	require 'db/usuarios_DB.php';

	
	class Usuarios {
		
		   public function crear_Usuario ($nombre,$userName,$password,$nivel,$descripcion) {

		 $usuario = new Usuarios_DB();	                   /* instanciamos la clase Personal  que se encuentra en el archivo cliente_DB.php*/
                 $respuesta=$usuario->crear_Usuario($nombre, $userName, $password, $nivel,$descripcion);  /* almacenamos en $respuesta el valor recibido del metodo crear_Articulo  */ 
                                                                         
                   return $respuesta;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
		}
                
                 public function consultar_Usuario ($userName) {

		 $usuario = new Usuarios_DB();	                   /* instanciamos la clase Articulo  que se encuentra en el archivo articulo_DB.php*/
                 $respuesta=$usuario->consultar_Usuario($userName);  /* almacenamos en $respuesta el valor recibido del metodo crear_Articulo  */ 
                                                                         
                   return $respuesta;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
		}
                
                public function obtenerusuarios () {

		 $todos = new Usuarios_DB;	                   /* instanciamos la clase Conectar que se encuentra en el archivo login_DB.php*/
                 $usuarios=$todos->obtener_Usuarios();  /* que esta en la carpeta db y creamos el objeto $clientes */ 
                                                                         
                   return $usuarios;        /* devolvemos el cliente encontrado a donde se haya invocado el metodo */
		}
                
                 public function editar_Usuario ($nuevoUserName,$userName,$nombre,$password,$nivel,$descripcion) {

		 $usuario = new Usuarios_DB();	                   /* instanciamos la clase Clientes_DB  que se encuentra en el archivo Clientes_DB.php*/
                 $usuario=$usuario->editar_Usuario($nuevoUserName, $userName,$nombre, $password, $nivel, $descripcion);
                                                                         
                   return $usuario;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
		}
                 public function eliminar_Usuario($nombreUsuario) {

		 $usuario = new Usuarios_DB();	                   /* instanciamos la clase Cliente_DB  que se encuentra en el archivo clientes_DB.php*/
                 $respuesta=$usuario->eliminar_Usuario($nombreUsuario);  /* almacenamos en $respuesta el valor recibido del metodo eliminar_Cliente  */ 
                                                                         
                   return $respuesta;        /* devolvemos el valor recibido a donde se haya invocado este metodo de esta clase*/
		}
                

	}

?>