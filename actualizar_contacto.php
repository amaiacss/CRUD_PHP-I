<!-- se mostrará en un formulario los datos del contacto, una vez modificados los datos estos se procesarán en esta misma página y se modificará el contacto en la tabla contactos llamando al método actualizar() del archivo modelo_contacto.php 1 -->
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
	<?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?>
	<title>Actualizar datos</title>	
	<style type="text/css">
		label.error {
			float: none;
			color: red;
			padding-left: .1em;
			vertical-align: middle;
			font-size: 13px;
		}
	</style>
</head>
<body>
	<div class="container">
		<!--NAVBAR-->
		   	<?php include("includes/cabecera_navbar.php");?>
		<!--FIN NAVBAR-->
		<br><br>
		<div class="table-title">
			<div class="row">
				<div class="col-md-8">
					<h2><strong>Actualizar Datos cliente</strong></h2>
				</div>
				<div class="col-sm-4">
		   			<a href="home.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i>Regresar</a>
		   		</div>
				   <div class="row">
		   			<div class="col-sm-12 text-center">
		   				<h3>Hola <?php echo $_SESSION['usuario'];?></h3>
		   			</div>
		   		</div>
			</div>	
		</div>

		<?php		
		$id = intVal($_GET['id']);
		require_once "modelo_contacto.php";
		$cliente = new Modelo_contacto();		
		$encontrado = $cliente->buscarPorId($id);
		if($encontrado){
			//Decodificamos los datos JSON recibidos 
			$array_clientes= json_decode($encontrado);
			
			foreach($array_clientes as $fila){
				$id = $fila->id;
				$nombre = $fila->nombre;
                $apellido = $fila->apellido;
                $ciudad = $fila->ciudad;
				$descripcion = $fila->descripcion;
			}			
			?>
			<div class="row">
				<form method="post" action="">
				<!--CÓDIGO-->
					<div class="col-md-6">
						<label>Código:</label>
						<input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $id; ?>" readonly>	
					</div>

				<!--NOMBRE-->
					<div class="col-md-12">
						<label>Nombre:</label>
						<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>">	
					</div>

                <!--APELLIDO-->
					<div class="col-md-12">
						<label>Apellido:</label>
						<input type="text" name="apellido" id="ape" class="form-control" value="<?php echo $apellido; ?>">	
					</div>

                <!--CIUDAD-->
					<div class="col-md-12">
						<label>Ciudad:</label>
						<input type="text" name="ciudad" id="ciu" class="form-control" value="<?php echo $ciudad; ?>">	
					</div>

				<!--DESCRIPCIÓN-->
					<div class="col-md-12">
						<label>Descripción:</label>
						<input type="text" name="descripcion" id="des" class="form-control" value="<?php echo $descripcion; ?>">
					</div>

				<!--BOTÓN GUARDAR CAMBIOS-->
					<div class="col-md-12">
						<hr>
						<button type="submit" class="btn btn-success">Actualizar datos</button>
					</div>
				</form>
			</div>

		<?php
			if(isset($_POST) && !empty($_POST)){
				$nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $ciudad = $_POST['ciudad'];
				$descripcion = $_POST['descripcion'];

				$res = $cliente->actualizar($nombre,$apellido,$ciudad,$descripcion,$id);
				if($res){
					$mensaje = "Datos actualizados correctamente";
		   			$class = "alert alert-success";
				}else{
					$mensaje = "No se pudo actualizar los datos ";
		   			$class = "alert alert-danger";
				}
				header("Refresh:3;URL=home.php");
				?>
				<div class="<?php echo $class;?>">
		   				<?php echo $mensaje; ?>
		   		</div>
		   	<?php
			}
		}
		?>	
	</div>	
</body>
</html>
<?php
    // No activar en el hosting
	 }else {
	 	echo "No existe sesión de usuario";
	 	header("Refresh:3; URL=index.php");
	}
	ob_end_flush();	
	?>

<!-- FINALIZADO -->