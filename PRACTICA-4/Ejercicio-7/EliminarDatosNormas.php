<!DOCTYPE html>
<html lang="es">
<head>
    <title>Eliminar</title>
    <meta charset="utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" />    
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Eliminar</h1>  
        <p>Eliminar una norma por nombre de comunidad</p>  
        <form method="post" action="" name="eliminarDatos">
                <p><label for = "ca">CCAA: </label> <input type="text" name="ca" id="ca" required/> </p> 
                <input type="submit" name="eliminar" value="Eliminar" />
        </form>
    <?php 
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['eliminar'])) {                
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                $registro = $bd->eliminarDatosNormas($ca['codigo']);
            }
        ?>
    </section>
</body>
</html>