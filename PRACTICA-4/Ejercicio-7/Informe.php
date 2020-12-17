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
        <p>Informe con los últimos datos registrados</p>
        <?php
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            $informe = $bd->generarInforme();
            
            $fecha = $informe['fecha'];
            $casos_nuevos = $informe['casos_nuevos'];
            $pruebas = $informe['pruebas'];
            $positividad = $informe['positividad'];
            $fallecidos = $informe['fallecidos'];
            $curados = $informe['curados'];
            $hospital_planta = $informe['hospital_planta'];
            $uci = $informe['uci'];
        
        
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
                    <input type='submit' name='inicio' value='Inicio'/>
                </form>
            ";
        ?>
    </section>
</body>
</html>