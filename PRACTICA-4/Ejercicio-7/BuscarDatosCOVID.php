<!DOCTYPE html>
<html lang="es">
<head>
    <title>Buscar</title>
    <meta charset="utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" />    
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Buscar</h1>  
        <p>Buscar datos de covid por comunidad autónoma:</p>  
        <form method="post" action="" name="buscarDatos">
                <p><label for = "ca">CCAA: </label> <input type="text" name="ca" id="ca" required/> </p> 
                <p><label for = "fecha">Fecha ('Y-m-d'): </label> <input type="text" name="fecha" id="fecha"/> </p> 
                <input type="submit" name="buscar" value="Buscar" />
        </form>
        <form method="get" action="Ejercicio7.php" name="Inicio">
            <input type="submit" name="inicio" value="Inicio"/>
        </form>
    <?php 
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['buscar'])) {               
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                $registro = NULL;
                if ($ca != NULL) {
                    $registro = $bd->buscarDatosCovid($ca['codigo'], $_POST['fecha']);
                }
                if ($registro != NULL) {
                    $fecha = $registro['fecha'];
                    $casos_nuevos = $registro['casos_nuevos'];
                    $pruebas = $registro['pruebas'];
                    $fallecidos = $registro['fallecidos'];
                    $curados = $registro['curados'];
                    $hospital_planta = $registro['hospital_planta'];
                    $uci = $registro['uci'];
                
                    echo "
                        <form method='get' action='Ejercicio7.php'>
                            <p>Fecha: $fecha</p>
                            <p>Casos nuevos: $casos_nuevos</p>
                            <p>Pruebas: $pruebas</p>
                            <p>Fallecidos: $fallecidos</p>
                            <p>Curados: $curados</p>
                            <p>Hospitalizados en planta: $hospital_planta</p>
                            <p>Ingresados en UCI: $uci</p>
                        </form>
                    ";
                }
            }
        ?>
    </section>
</body>
</html>