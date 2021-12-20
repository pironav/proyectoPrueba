<?php
	
	require 'db/login_DB.php';

	
	class login_M {
		
		public function confirmarUsuario ($usuario,$password) {

		   $confirmar = new Checklogin();	                   /* instanciamos la clase ChecLogin que se encuentra en el archivo login_DB.php*/
                   $encontrado=$confirmar->checking($usuario, $password);  /* que esta en la carpeta db y creamos el objeto $ confirmar */ 
                                                                           /* creamos la variable $encontrado a la cual se le asigna el valor enviado por el metodo chhecking */
                   return $encontrado;        /* devolvemos el valor encontrado a donde se haya invocado el metodo */
		}
                public function obtenerUsuario ($usuario,$password) {

		   $USUARIO = new Checklogin();	                   /* instanciamos la clase ChecLogin que se encuentra en el archivo login_DB.php*/
                   $encontrado=$USUARIO->obtenerUsuario($usuario, $password);  /* que esta en la carpeta db y creamos el objeto $ confirmar */ 
                                                                           /* creamos la variable $encontrado a la cual se le asigna el valor enviado por el metodo chhecking */
                   return $encontrado;        /* devolvemos el usuario encontrado a donde se haya invocado el metodo */
		}

		

	}

?>