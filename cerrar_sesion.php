<!--cerrar la seisón del usuario actual.  -->
<?php
    ob_start();
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Refresh:3;URL=index.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body id="cerrar">
    <div>
        <h1>Cerrando sesión.....</h1>
    </div>    
</body>
</html>

<!-- FINALIZADO-->