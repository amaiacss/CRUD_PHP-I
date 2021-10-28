<!-- 3.Crear un archivo llamado conexion.php con la extensión PDO y controlando excepciones de conexión. -->

<?php
class Conexion extends PDO {
    // Propiedades
    private $tipo_bd = "mysql";
    private $host = "localhost";
    private $bd = "contacto_clientes";
    private $usuario = "root";
    private $pass = "";

    //Constructor de la clase Conexíon
	public function __construct(){
		try{
			parent::__construct(
				"{$this->tipo_bd}:host={$this->host};
					dbname={$this->bd};charset=utf8",
					$this->usuario,
					$this->pass);							
			}catch (PDOException $e){
				echo "Se ha producido un error de conexión con la BD"
				. $e->getMessage(); 
				exit;
			}
		}// STOP __construct()        
}// STOP class Conexion
?> 
<!-- FINALIZADO -->

