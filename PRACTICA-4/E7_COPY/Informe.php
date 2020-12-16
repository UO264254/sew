<!DOCTYPE html>
<html lang="es">
<head>
    <title>Informe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>   
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Informe</h1>
        <p>Informe con los datos de la últimos datos registrados</p>
        <?php
        $fecha="";
        $casos_nuevos="";
        $pruebas="";
        $positividad="";
        $fallecidos="";
        $curados="";
        $hospital_planta="";
        $uci="";
        if (isset($_GET['fecha'])) {
            $fecha=$_GET['fecha'];
        } if (isset($_GET['casos_nuevos'])) {
            $casos_nuevos=$_GET['casos_nuevos'];
        } if (isset($_GET['pruebas'])) {
            $pruebas=$_GET['pruebas'];
        }if (isset($_GET['positividad'])) {
            $positividad=$_GET['positividad'];
        }if (isset($_GET['fallecidos'])) {
            $fallecidos=$_GET['fallecidos'];
        }if (isset($_GET['curados'])) {
            $curados=$_GET['curados'];
        }if (isset($_GET['hospital_planta'])) {
            $hospital_planta=$_GET['hospital_planta'];
        }if (isset($_GET['uci'])) {
            $uci=$_GET['uci'];
        }
        
        echo "
            <form method='get' action='Ejercicio7.php'>
                <img src='multimedia/icono.jpg' alt=' icono de España' />
                <p><b>Fecha:</b> $fecha</p>
                <p><b>Casos nuevos:</b> $casos_nuevos</p>
                <p><b>Pruebas:</b> $pruebas</p>
                <p><b>Positividad:</b> $positividad</p>
                <p><b>Fallecidos:</b> $fallecidos</p>
                <p><b>Curados:</b> $curados</p>
                <p><b>Hospitalizados en planta:</b> $hospital_planta</p>
                <p><b>Ingresados en UCI:</b> $uci</p>
            
            </form>
        ";
        ?>
    </section>
</body>
</html>