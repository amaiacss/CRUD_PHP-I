<!-- 7.Crear la clase llamada modelo_contacto.php esta clase debe contener las propiedades de la tabla contactos, los métodos getters y setters y los métodos listar(), insertar(), actualizar() y borrar(), todos estos métodos deben usar sentencias preparadas para realizar sus consultas y controlar los errores de Excepción.  -->
<?php
    require_once "Conexion.php";
    class Modelo_contacto {
        private $id;
        private $nombre;
        private $apellido;
        private $ciudad;
        private $descripcion;
        const TABLA="cliente";

        // GETTERS
        public function getId() {
            return $this->id;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->Apellido;
        }

        public function getCiudad() {
            return $this->Ciudad;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }
        // SETTERS
        public function setNombre($nombre) {
            $this->nombre=$nombre;
        }

        public function setApellido($apellido) {
            $this->apellido=$apellido;
        }

        public function setCiudad($ciudad) {
            $this->ciudad=$ciudad;
        }

        public function setDescripcion($descripcion){
			$this->descripcion=$descripcion;
		}

        //MÉTODOS CRUD
		public function insertar($nombre,$apellido,$ciudad,$descripcion){
			try {
				$conexion = new Conexion();
				if($conexion){					
					$sql=$conexion->prepare("INSERT INTO contactos(nombre,apellido,ciudad,descripcion) VALUES(:nom,:ape,:ciu,:des)");
					$sql->bindParam('nom',$nombre);
                    $sql->bindParam('ape',$apellido);
                    $sql->bindParam('ciu',$ciudad);
					$sql->bindParam('des',$descripcion);
					$sql->execute();
					
					$this->id = $conexion->lastInsertId();
					return true;
				}else {
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally {
				$sql = null; //cerramos la consulta
				$conexion = null; //cerramos la conexión
			}
		}

        public function listar(){
			try {
				$conexion = new Conexion();
				if($conexion){
					$sql = $conexion->prepare("SELECT * FROM contactos");
					$sql->execute();
					$res = $sql->fetchAll(PDO::FETCH_OBJ);
					
					$convertir_a_json = json_encode($res);
					return $convertir_a_json;
				}else {
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally{
				$sql = null;
				$conexion = null; //cerramos la conexión
			}
		}

        public function actualizar($nombre,$apellido,$ciudad,$descripcion,$id){
			try{
				$conexion = new Conexion();				
				if($conexion){
					//MODO MARCADORES
					$sql = $conexion->prepare("UPDATE contactos SET nombre=:nom, apellido=:ape,ciudad=:ciu,descripcion=:des WHERE id=:id");
					$sql->bindParam('nom',$nombre);
                    $sql->bindParam('ape',$apellido);
                    $sql->bindParam('ciu',$ciudad);
					$sql->bindParam('des',$descripcion);				
					$sql->bindParam('id',$id);					
					$sql->execute();
					return true;
				}else{
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally{
				$sql = null;
				$conexion = null;
			}
		}

        public function borrar($id){
			try{
				$conexion = new Conexion();
				if($conexion){
					//MODO MARCADORES
					$sql = $conexion->prepare("DELETE FROM contactos WHERE id=:id");
					$sql->bindParam('id',$id);					
					$sql->execute();
					return true;
				}else {
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally{
				$sql = null;
				$conexion = null;
			}
		}

		public function buscarPorId($id) {
			try {
				$conexion = new Conexion();
				//MODO MARCADORES
				$sql = $conexion->prepare("SELECT * FROM contactos WHERE id=:cod");
				$sql->bindParam('cod',$id);				
				$sql->execute();
				$res= $sql->fetchAll(PDO::FETCH_OBJ);
				//Codificamos los datos en formato JSON
				$convertir_a_json = json_encode($res);
				return $convertir_a_json;
			}catch(Exception $e){
				die($e->getMessage());
			}finally{
				$sql = null;
				$conexion = null;
			}
		}
    } // STOP class Modelo_contacto
?>

<!-- FINALIZADO -->