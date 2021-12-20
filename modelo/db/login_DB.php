<?php
	
	//Esta es la clase mas importante, porque es la que se encarga de la verificacion, en primer lugar introducimos el archivo de la conexion a la base de datos
	require 'conexiones/db_conect.php';

	//Heredamos de la clase db_conet para tener acceso a su constructor (que es el que se encarga de conectar con esta)
	class Checklogin extends Db_conect {
		
		public function __construct() {

			//Llamamos al constructor de la superclase para realizar la conexion
			parent::__construct();

		}

		//El metodo checking es el que recibe los parametros del input y realiza el trabajo de comprovacion */
		public function checking($usuario, $password) {

			$sql="SELECT * FROM usuarios WHERE username=:marcador1 AND password=:marcador2";  // la sentencia sql  usando marcadores para evitar inyeccion

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos el campo extraido, con el marcador
			$sentence->bindValue(":marcador1", $usuario);

			$sentence->bindValue(":marcador2", $password);

			$sentence->execute();

			$row_number = $sentence->rowCount();  // nos indica el numero de registros encontrados

			

			//Cerramos la conexion a la base de datos
			$this->conexion = null;
                        
                         return $row_number;

		}
                public function obtenerUsuario($usuario, $password) {

			$sql="SELECT * FROM usuarios WHERE username=:marcador1 AND password=:marcador2";  // la sentencia sql  usando marcadores para evitar inyeccion

			$sentence = $this->conexion->prepare($sql);  // metodo implicito 

			//Ahora vinculamos el campo extraido, con el marcador
			$sentence->bindValue(":marcador1", $usuario);

			$sentence->bindValue(":marcador2", $password);

			$sentence->execute();
                       $resultado=$sentence->fetchall(PDO::FETCH_ASSOC);//  utilizamos el metodo fetcall del objeto sentencia para guardar
                      // los registros obtenidos al ejecutar la sentencia y lo guardamos en un arrays de tipo asociativo

                     //   $nombre=$resultado[0]['name'];

                       
                       
                       
                      $sentence->closeCursor;  //cerramos la sentencia
   
                      $this->conexion=NULL;


                     

                      return $resultado;  // devuelve $personal a donde fue invocado el metodo

		}

	}

?>