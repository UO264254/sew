<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar</title>
    <meta charset="utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" />    
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Modificar</h1>  
        <p>Modificar datos de covid por comunidad autónoma:</p>  
       
      
    <?php 
            $ca="";
            $fecha="";
            $casos_nuevos=0;
            $pruebas=0;
            $fallecidos=0;
            $curados=0;
            $hospital_planta=0;
            $uci=0;
            $id=0;
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['leer'])) {               
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                $registro = $bd->buscarDatosCovid($ca['codigo'], $_POST['fecha']);
                $ca = $ca['nombre'];
                $fecha = $registro['fecha'];
                $casos_nuevos = $registro['casos_nuevos'];
                $pruebas = $registro['pruebas'];
                $fallecidos = $registro['fallecidos'];
                $curados = $registro['curados'];
                $hospital_planta = $registro['hospital_planta'];
                $uci = $registro['uci'];
                $id = $registro['id'];
            }

            echo "
            <form method='post' action='' name='leerDatos'>
                <p><label for='ca'> Comunidad/ciudad Aut.:</label><input type='text' name='ca' id='ca' value='$ca' ";
            
            if (isset($_POST['leer'])) {
                echo " readonly";
            }

            echo "/> </p>
                <p><label for='fecha'> Fecha(Y-m-d):</label><input type='text' name='fecha' id='fecha' value='$fecha' ";
            
            if (isset($_POST['leer'])) {
                echo " readonly";
            }

            echo "/> </p> 

                <input type='submit' name='leer' value='Leer'" ;

            if (isset($_POST['leer'])) {
                echo " disabled";
            }
                
                echo "/>
            </form>";

            if (isset($_POST['leer'])) {               
                echo "
                    <form method='post' action=''>
                        <p><label for = 'casosNuevos'>Casos nuevos: </label> <input type='text' name='casosNuevos' id='casosNuevos' required value='$casos_nuevos' /> </p>
                        <p><label for = 'pruebas'>Pruebas: </label> <input type='text' name='pruebas' id='pruebas' required value='$pruebas' /> </p>
                        <p><label for = 'fallecidos'>Fallecidos: </label> <input type='text' name='fallecidos' id='fallecidos' required value='$fallecidos' /> </p>
                        <p><label for = 'curados'>Curados: </label> <input type='text' name='curados' id='curados' required value='$curados' /> </p>
                        <p><label for = 'hospital_planta'>En planta del hospital: </label> <input type='text' name='hospital_planta' id='hospital_planta' required value='$hospital_planta' /> </p>
                        <p><label for = 'uci'>En UCI: </label> <input type='text' name='uci' id='uci' required value='$uci' /> </p>
                        <input type='submit' name='modificar' value='Modificar' />
                        <label for = 'id' hidden>id:</label><input type='text' name='id' id='id' value='$id' hidden/>
                    </form>
                ";
            } 
            if (isset($_POST['modificar'])) {
                $registro['casos_nuevos'] = $_POST['casosNuevos'];
                $registro['pruebas'] = $_POST['pruebas'];
                $registro['fallecidos'] = $_POST['fallecidos'];
                $registro['curados'] = $_POST['curados'];
                $registro['hospital_planta'] = $_POST['hospital_planta'];
                $registro['uci'] = $_POST['uci'];
                $registro['id'] = $_POST['id'];
                
                $bd->modificarDatosCOVID($registro);
            } 
        ?>
    </section>
</body>
</html>