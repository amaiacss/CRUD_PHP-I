<!--4.Crear una clase llamada modelo_user.php esta clase debe contener las propiedades de la tabla users, los métodos getters y setters y los métodos insertar_user() y autenticar_user(). En el método  insertar_user() se debe realizar la consulta SQL con sentencias preparadas y el método autenticar_user() debe comprobar que el usuario existe en la tabla users desencriptando el password con el método password_verify().  -->

<?php
class Modelo_user {
    private $id;
    private $user;
    private $pass;

// GETTERS
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->user;
    }

    public function getPass() {
        return $this->pass;
    }

// SETTERS
    public function setId($id) {
        $this->id=$id;
    }

    public function setUsuario($user) {
        $this->user=$user;
    }

    public function setPass($pass) {
        $this->pass=$pass;
    }

// INSERTAR USUARIO
    public function insertar_user($user,$pass) {
        try {
            $conexion = new Conexion();
            if($conexion) {
                $sql = $conexion->prepare("INSERT INTO users(user, pass) VALUES(:usuario, :pass)");
                $sql->bindParam("usuario", $user);
                $sql->bindParam("pass", $pass);

                $sql->execute();
                return true;
            } else {                
                return false;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }finally {
            $sql = null;
        }
    } // STOP insertar_user

// AUTENTICAR USUARIO
    public function autenticar_user($user,$pass) {
        try {
            $conexion = new Conexion();
            if($conexion) {
                $sql = $conexion->prepare("SELECT user, pass FROM users WHERE user='$user'");
                $sql->execute();
                while($registro=$sql->fetch(PDO::FETCH_OBJ)) {
                    if(password_verify($pass,$registro->pass)) {
                        session_start();
                        $_SESSION['usuario'] = $registro->user;
                        return true;
                    }else {
                        return false;
                    }
                }
            }else {
				return false;
			}
		}catch(Exception $e){
			die($e->getMessage());
		}finally{
			$sql = null;
		}
    }// STOP autenticar_user
} // STOP class modelo_user
?>

<!-- FINALIZADO -->