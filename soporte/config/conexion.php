<?php
    session_start();

    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
				/*Locahost
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=registro_ticket","root","1111");*/

                /*Produccion*/
                $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=cvi5523_registro_ticket","cvi5523_root","Kroma.2010");
                
				return $conectar;	
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();	
			}
        }

        public function set_names(){	
			return $this->dbh->query("SET NAMES 'utf8'");
        }
        
        public static function ruta(){
            //Ruta Proyecto Local
			//return "http://localhost/prueba/soporte/";

            //Ruta Produccion

            return "http://virtuanet.cl/soporte/";
		}
    }
?>