<!-- se mostrará un formulario para insertar el nuevo contacto, los datos introducidos en el formulario se tratarán en esta misma página y se insertarán en la tabla contactos llamando al método insertar() del archivo modelo_contacto.php 1 -->
<?php
   ob_start();
   session_start(); //reanudar
   if(isset($_SESSION['usuario'])){
   ?>
   <!DOCTYPE html>
   <html lang="es">
   <head>
   	<meta charset="UTF-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   	<title>Formulario Registro clientes</title>
   	<?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?>	
   </head>
   <body>
   		<div class="container">
   			<!--NAVBAR-->
		   	<?php include("includes/cabecera_navbar.php");?>
		   	<!--FIN NAVBAR-->
		   	<br>
		   	<div id="inical" align="center">
		   		<!-- <h2>INSERTAR CLIENTE</h2> -->
		   		<div class="row">
		   			<div class="col-sm-12 text-center">
		   				<h3>Hola <?php echo $_SESSION['usuario'];?></h3>
		   			</div>
		   		</div>

		   		<div class="table-title">
		   			<div class="row">
		   				<div class="col-sm-8">
		   					<h2><strong>Insertar nuevo cliente</strong></h2>
		   				</div>
		   				<div class="col-sm-4">
		   					<a href="pagina_home.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i>Regresar</a>
		   				</div>
		   			</div>
		   		</div>

		   		<!--Creamos el formulario-->
		   		<div class="container"> 
		   			<div class="row">
		   				<form method="post" action="">
		   					<!--NOMBRE-->
		   					<div class="col-lg-12" form-group>
		   						<label>Nombre:</label>
		   						<input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required="">	
		   					</div>
		   					<!--APELLIDO-->
		   					<div class="col-lg-12" form-group>
		   						<label>Apellido:</label>
		   						<input type="text" name="apellido" id="ape" class="form-control" maxlength="255" required="">	
		   					</div>
                            <!--CIUDAD-->
		   					<div class="col-lg-12" form-group>
		   						<label>Ciudad:</label>
		   						<input type="text" name="ciudad" id="ciu" class="form-control" maxlength="255" required="">	
		   					</div>
                            <!--DESCRPCION-->
		   					<div class="col-lg-12" form-group>
		   						<label>Descripción:</label>
		   						<input type="text" name="desc" id="des" class="form-control" maxlength="255" required="">	
		   					</div>
		   					<!--BOTÓN ENVIAR-->
		   					<div class="col-md-12 pull-right">
		   						<hr>
		   						<button type="submit" class="btn btn-success">Guardar</button>
		   					</div>
		   				</form>
		   			</div>	
		   		</div>
		   	</div>

		   	<?php
		   		
		   		require_once"modelo_contacto.php";
		   		$cliente = new Modelo_contacto();

		   		//Comprobamos si nos llegan datos desde el formulario
		   		if(isset($_POST) && !empty($_POST)){
		   			$nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $ciudad = $_POST['ciudad'];
		   			$descripcion = $_POST['desc'];

		   			$cliente->setNombre($nombre);
                    $cliente->setApellido($apellido);
                    $cliente->setCiudad($ciudad);
		   			$cliente->setDescripcion($descripcion);
		   			
		   			$res = $cliente->insertar($nombre,$apellido,$ciudad,$descripcion);
		   			if($res){
		   				$mensaje = "Datos insertados correctamente";
		   				$class = "alert alert-success";
		   				header("Refresh:3;URL=home.php");
		   			}else {
		   				$mensaje = "No se pudo insertar los datos ";
		   				$class = "alert alert-danger";
		   				header("Refresh:3;URL=insertar_contaco.php");
		   			}
		   			?>
		   			<div class="<?php echo $class;?>">
		   				<?php echo $mensaje; ?>
		   			</div>
		   			<?php
		   		}
		   	?>
   		</div>
   </body>
   </html>
   <?php
}else {
	echo "No existe sesión de usuario";
	header("Refresh:3; URL=index.php");
	ob_end_flush();
}	
?>
<!-- FINALIZADO -->