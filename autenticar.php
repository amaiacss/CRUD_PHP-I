<!-- proceso de autenticación, y el usuario existe inicie una sesión para este usuario y nos envíe a una página llamada home.php, si el usuario que hace login no existe debe enviarnos de nuevo a la página index.php. -->

<!-- iniciar una sesión para este usuario llamando al método autenticar_user() de modelo_user() y redirigirle a home.php -->
<?php
    ob_start();
    require_once "Conexion.php";
    include("Modelo_user.php");
    $usuario = new Modelo_user();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
    <?php
		include("includes/cabecera_bootstrap.php");
		include("includes/fuentes_awesome.php");
	?>
</head>
<body>
<div class="container">
	<?php	
	$user = htmlentities(addslashes($_POST['usuario']));
	$pass = htmlentities(addslashes($_POST['pass']));
	
	$usuario->setUsuario($user);
	$usuario->setPass($pass);
	
    $respuesta = $usuario->autenticar_user($usuario->getUsuario(), $usuario->getPass());
    if($respuesta){
    	$mensaje = "Acceso Autorizado";
    	$class = "alert alert-success";
    	header("Refresh:2; URL=home.php");
    }else {
    	$mensaje = "Acceso No Autorizado";
    	$class = "alert alert-danger";
    	header("Refresh:3; URL=index.php");
    }   
	?>
	<div class="<?php echo $class;?>">
		<?php echo $mensaje;?>
	</div>
</div>
    
</body>
</html>

<!-- FINALIZADO -->