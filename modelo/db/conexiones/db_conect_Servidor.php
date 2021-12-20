<?php
	
	// esta es la conexion para poner en el servidor de caracas hosting , 
	class Db_conect {

		protected $conexion;

		public function __construct() {

			try {
				
				$pdo_options = array(

			    	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

				);

				$this->conexion = new PDO('mysql:host=localhost; dbname=vikinaic_vikinai', 'vikinaic_victor', 'pirona1313', $pdo_options);

				$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $this->conexion;

			} catch (PDOException $e) {

				echo "Error de conexión en linea: " . $e->getLine();
				
			}

		}

	}

?>