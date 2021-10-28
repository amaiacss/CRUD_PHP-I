<!-- aplicación que inicialmente nos pida el login, si no hay ningún usuario creado nos permita crear o registrar uno -->

<!-- 6.Crear un archivo index.php donde nos mostrará un formulario para hacer login y una opción para poder registrarse, si hace login deberá ir a la página autenticar.php e iniciar una sesión para este usuario llamando al método autenticar_user() de modelo_user() y redirigirle a home.php y si pulsa en la opción de registrar ir a la página registrar.php. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php 
		include("includes/cabecera_bootstrap.php"); 
		include("includes/fuentes_awesome.php");
	?> 
	<link rel="stylesheet" type="text/css" href="css/estilos_login.css">   
</head>
<body>
<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3>Login</h3>
				</div>
				<div class="card-body">
					<form method="post" action="autenticar.php">
					<!--USUARIO-->
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-user"></i>
								</span>	
							</div>
							<input type="text" name="usuario" class="form-control" placeholder="usuario">	
						</div>
					<!--PASS-->
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-key"></i>
								</span>	
							</div>
							<input type="password" name="pass" class="form-control" placeholder="password">	
						</div>
						<br>
					<!--BOTÓN ENTRAR-->
						<div class="form-group">
							<input type="submit" value="Acceder" class="btn float-right login-btn">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						No tienes cuenta?<a href="registrar.php">Registrar</a>
					</div>	
				</div>
			</div>	
		</div>	
	</div>
    
</body>
</html>

<!-- COMPLETADO -->