<!-- 5.Crear el archivo registrar.php debe contener un formulario para recoger los datos de nuevo usuario y enviar los datos a esta misma página(registrar.php) para tratar los datos recibidos con php y cifrar la contraseña con el algoritmo blowfish   password_hash() con un ‘cost’ de 20. -->
<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro usuario</title>
    <?php
		include("includes/cabecera_bootstrap.php");
		include("includes/fuentes_awesome.php");
	?>
</head>
<body>
    <div class="container">
        <div class="signup-form-container">
<!--el formulario enviará los datos a esta misma página-->
            <form method="post" id="register-form" role="form" autocomplete="off" action="">
<!--CABECERA DEL FORMULARIO-->
                <div class="card-header">
                    <h3 class="form-title"><i class="fa fa-user"></i>Registrar Usuario</h3>
                    <div class="pull-right">
                        <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
                    </div>
                </div>
<!--BODY DEL FORMULARIO-->
                <div class="card-body">
    <!--USUARIO-->
                    <div class="form-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" name="usuario" placeholder="usuario" required="">
                    </div>
                    <span class="help-block" id="error"></span>    
    <!--PASSWORD-->
                    <div class="row">
    <!--PEDIR PASSWORD 1-->
                        <div class="form-group col-lg-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>	
                                </div>
                                <input class="form-control" id="pass" type="password" name="pass" placeholder="password" required="">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
    <!--PEDIR PASSWORD 2-->
                        <div class="form-group col-lg-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>	
                                </div>
                                <input class="form-control" type="password" name="pass2" placeholder="Repetir password" required="">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>				
                    </div>
                </div>

    <!--FOOTER DEL FORMULARIO-->
                <div class="card-footer">
                    <div class="row">
                        <button type="submit" class="btn btn-info">
                            <span class="glyphicon glyphicon-log-in"></span>
                                Registrar!
                        </button>
                        <a href="index.php" class="btn btn-info">
                                Volver
                        </a>
                    </div>
                </div>
            </form>	
        </div>	
    </div>

    <?php
    require_once "conexion.php";
    include("modelo_user.php");
    $user = new modelo_user();

    if(isset($_POST) && !empty($_POST)) {
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if($pass == $pass2) {
            $pass_cifrada = password_hash($pass,PASSWORD_DEFAULT,array("cost"=>15));

            $user->setUsuario($usuario);
            $user->setPass($pass_cifrada);

            $respuesta=$user->insertar_user($user->getUsuario(), $user->getPass());
            $mensaje="";
            $class="";
            if($respuesta) {
                $mensaje = "Usuario insertado correctamente";
				$class="alert alert-success";
                header("Refresh:3; URL=index.php");
            }else{
                $mensaje="Error! no se pudo insertar el usuario, vuelvalo a intentar";
                $class="alert alert-danger";
                header("Refresh:3;");
            }        
        } else {
            $mensaje="Error! las contraseñas no coinciden, vuelvalo a intentar";
            $class="alert alert-danger";
            header("Refresh:3;");
        }//STOP if de la contraseña
    ?>
    <div class="<?php echo $class;?>">
        <?php echo $mensaje; ?>
    </div>
	<?php
	}  // STOP if   
	?>    
</body>
</html>
<!-- FINALIZADO, el cost lo he puesto de 20 pero tarda mucho en ejecutarse -->