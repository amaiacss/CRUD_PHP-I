<!-- muestre el nombre del usuario que ha iniciado sesión y nos muestre una tabla con un listado de los clientes almacenados en la BD y  nos permita realizar operaciones de CRUD (Insertar, Editar-Actualizar, Borrar) para gestionar los clientes, -->

<!-- 8.Crear una página llamada home.php:
1.Aquí debemos reanudar la sesión del usuario autenticado. 0,5
2.Mostrar un navbar de bootstrap 4 con los enlaces (almacen, produccion, ventas y cerrar sesión) 0,5
3.Agregar un link a las fuentes de awesomefont para disponer de iconos 0,5
4.Un botón que nos permita insertar nuevos contactos de clientes y que debe redirigir a la página insertar_contacto.php 
5.Listar en una tabla todos los registros existentes de la tabla contactos y en una columna de la tabla que llamaremos acción poner 2 botones con iconos de Editar y Eliminar para cada registro que se muestre:
5.1 Si se pulsa sobre el botón Editar debe redirigirnos a la página actualizar_contacto.php
5.2 Si se pulsa sobre el botón Borrar debe redirigirnos a la página borrar_contacto.php   -->
<?php
// En el hosting no activar
ob_start();
session_start(); //reanudar
if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
   	<meta charset="UTF-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   	<title>Home</title>
	<?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?>	
    <link rel="stylesheet" type="text/css" href="css/estilos_home.css">	
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
   	<div class="container">
<!--NAVBAR-->
	    <?php include("includes/cabecera_navbar.php");?>
<!--FIN NAVBAR-->
	    <div id="caja_bienvenido">
	   	    <h2>Usuarios Autorizados</h2> 	
   	    </div>
   	    <br>
   	    <div id="inical" align="center">
		    <h2>GESTIÓN DE CLIENTES</h2>
		    <div class="row">
			    <div class="col-sm-12 text-center">
				    <h3>Hola <?php echo $_SESSION['usuario'];?></h3>
			    </div>
	 	    </div>
<!--Creamos un botón para Insertar clientes-->
		    <div class="row">
			    <div class="col">
			    	<span class="float-right"><a href="insertar_contacto.php" class="btn btn-primary" title="Insertar">Insertar</a></span>	
		        </div>
		    </div>
		    <br>
<!--Listamos todos los clientes-->
<?php
	require_once "modelo_contacto.php";	
	$cliente = new Modelo_contacto();
	//Consulta guarda el resultado en formato JSON
	$consulta = $cliente->listar();
	if($consulta){
		//Decodificamos los datos JSON devueltos
		$array = json_decode($consulta);		
	}else {
		echo "No hay registro para mostrar";
	}
?>
<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>CIUDAD</th>
					<th>DESCRIPCIÓN</th>
					<th>ACCIÓN</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($array as $fila){
						$id = $fila->id;
						$nombre = $fila->nombre;
                        $apellido = $fila->apellido;
                        $ciudad = $fila->ciudad;
						$descripcion = $fila->descripcion;
					?>
					<tr>
						<td><?php echo $id;?></td>
						<td><?php echo $nombre;?></td>
                        <td><?php echo $apellido;?></td>
                        <td><?php echo $ciudad;?></td>
						<td><?php echo $descripcion;?></td>
					<!--Iconos para editar y borrar-->
						<td>
						<!--EDITAR-ACTUALIZAR-->
							<a href="actualizar_contacto.php?id=<?php echo $id;?>" class="edit" title="editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

						<!--BORRAR-->
							<a href="borrar_contacto.php?id=<?php echo $id;?>" class="delete" title="borrar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
						</td>
					</tr>
					<?php
					} //cierre del foreach
				?>
			</tbody>
		</table>
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
	ob_end_flush();
	?>

<!-- FINALIZADO -->