<!DOCTYPE html>
<html lang="es">
<head>
    <title>Insertar</title>
    <meta charset="utf-8"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Formulario</h1>  
        <p>Datos de hoy de incidencia COVID en CCAA</p>
        <form method="post" action="" name="insertarDatos">
            <p><label for="ca"> Comunidad/Ciudad Autónoma:</label> <input type="text" name="ca" id="ca" required/> </p>
            <p><label for="casos_nuevos">Casos Nuevos:</label> <input type="number" name="casos_nuevos" id="casos_nuevos" required/> </p>
            <p><label for="pruebas" >Número de pruebas realizadas: </label> <input type="number" name="pruebas" id="pruebas" required/> </p>
            <p><label for="fallecidos" >Fallecidos:</label> <input type="number" name="fallecidos" id="fallecidos" required/></p>
            <p><label for="curados">Curados:</label> <input type="number" name="curados" id="curados" required/> </p>
            <p><label for="hospital_planta" >Ingresos planta: </label> <input type="number" name="hospital_planta" id="hospital_planta" required/> </p>
            <p><label for="uci" >Ingresos UCI:</label> <input type="number" name="uci" id="uci" required/></p>
            <input type="submit" name="insertar" value="Insertar" />
        </form>
        <form method="get" action="Ejercicio7.php" name="Inicio">
            <input type="submit" name="inicio" value="Inicio"/>
        </form>
        <?php 
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['insertar'])) {
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                if($ca != NULL){
                    $registro['codigo'] = $ca['codigo'] ;
                    $registro['fecha'] = date('Y-m-d'); //hoy en formato año-mes-día
                    $registro['casos_nuevos'] = $_POST['casos_nuevos'];
                    $registro['pruebas'] = $_POST['pruebas'];
                    $registro['fallecidos'] = $_POST['fallecidos'];
                    $registro['curados'] = $_POST['curados'];
                    $registro['hospital_planta'] = $_POST['hospital_planta'];
                    $registro['uci'] = $_POST['uci'];
                    $bd->insertarDatosCOVID($registro);
                }
                
            }
        ?>
    </section>
</body>
</html>