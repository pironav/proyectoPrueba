<?php
	
	//Como Juan ya explico en el video correspondiente, aqui solo se crea una clase que realizara la conexion a la base de datos con el PDO
	class Db_conect {

		protected $conexion;

		public function __construct() {

			try {
				
				$pdo_options = array(

			    	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

				);

				$this->conexion = new PDO('mysql:host=localhost; dbname=detodo', 'root', 'viki1234', $pdo_options);
                               // $this->conexion = new PDO('mysql:host=localhost; dbname=vikinaic_vikinai', 'vikinaic_pirona', 'pirona1313', $pdo_options);
				$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $this->conexion;

			} catch (PDOException $e) {

				echo "Error de conexión en linea: " . $e->getLine();
				
			}

		}

	}

?>