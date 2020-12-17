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
        <p>Eliminar un registro por nombre de comunidad y fecha:</p>  
        <form method="post" action="" name="eliminarDatos">
                <p><label for = "ca">CCAA: </label> <input type="text" name="ca" id="ca" required/> </p> 
                <p><label for = "fecha">Fecha: </label> <input type="text" name="fecha" id="fecha"/> </p> 
                <input type="submit" name="eliminar" value="Eliminar" />
        </form>
        <form method="get" action="Ejercicio7.php" name="Inicio">
            <input type="submit" name="inicio" value="Inicio"/>
        </form>
    <?php 
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['eliminar'])) {     
                if (isset($_POST['fecha'])) {
                    $fecha = $_POST['fecha'];
                    if ($fecha==NULL or empty($fecha)) {
                        $fecha = date('Y-m-d'); //hoy en formato año-mes-día
                    }
                }
                
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                if ($ca!=NULL) {
                    $registro = $bd->eliminarDatosCovid($ca['codigo'], $fecha);
                }
                
                
            }
        ?>
    </section>
</body>
</html>