<?php
session_start();
if(isset($_SESSION['usuario'])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Producción</title>
	<?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body id="produccion">
	<div class="container">
		<!--NAVBAR-->
	    <?php include("includes/cabecera_navbar.php");?>
		<!--FIN NAVBAR-->
		<div class="col-sm-6 text-center p-5">
		    <h3>Hola <?php echo $_SESSION['usuario'];?></h3>
		</div>
	</div>	
</body>
</html>
<?php
    // No activar en el hosting
	 }else {
	 	echo "No existe sesión de usuario";
	 	header("Refresh:3; URL=index.php");
	}
?>