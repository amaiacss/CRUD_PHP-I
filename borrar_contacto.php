<!-- 2.nos debe preguntar si realmente queremos borrar este contacto: 1
1.Si se responde SÍ se llamará al método borrar() del archivo modelo_contacto.php y se borrará el registro.
2.Si se responde NO se redirigirá a la página home.php  -->
<?php
    ob_start();
    session_start(); //reanudar
 if(isset($_SESSION['usuario'])){   
    $id = intval($_GET['id']);
    require_once "modelo_contacto.php";
    $cliente = new Modelo_contacto();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?>
    <title>Borrar los datos</title>  
</head>
<body>
    <div class="container"> 
		<!--NAVBAR-->
		   	<?php include("includes/cabecera_navbar.php");?>
		<!--FIN NAVBAR-->
		<br><br>
        <div class="row">
		   	<div class="col-sm-12 text-center">
		   		<h3>Bienvenido/a <?php echo $_SESSION['usuario'];?></h3>
		   	</div>
		</div>
        
        <div class="col-sm-12 text-center">
            <h2>¿Borrar datos del cliente?</h2>
            <h3>¿Está seguro de borrar este cliente?</h3>
            <br>
            <form action="" method="post">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success" name="borrar" value="si">Sí</button>

                    <button type="submit" class="btn btn-danger" name="noborrar" value="no">No</button>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>
            </form>
        </div>
        <?php            
            if(isset($_POST['borrar']) && !empty($_POST)) {
                $res = $cliente->borrar($id);
                if($res) {
                    $mensaje = "Registro borrado correctamente";
                    $class = "alert alert-success";
                    header("Refresh:3;URL=home.php");
                }else {
                    $mensaje = "No se pudo borrar los datos ";
                    $class = "alert alert-danger";
                    header("Refresh:3;URL=home.php");              
                }
                header("Refresh:3;URL=home.php"); 	
                   ?>
                   <div class="<?php echo $class;?>">
                    <?php echo $mensaje;?>
                   </div>	
            <?php	
            }else if(isset($_POST['noborrar'])) {
                header("Refresh:1;URL=home.php");	
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

<!-- FINALIZADO-->