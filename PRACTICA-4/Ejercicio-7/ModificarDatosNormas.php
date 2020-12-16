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
        <p>Modificar datos de normas:</p>  
       
      
    <?php 
            $ca="";
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['modificar'])) {
                $registro['bares'] = $bares;
                $registro['toque_queda'] = $toque_queda;
                $registro['distancia_interpersonal'] = $distancia_interpersonal;
                $registro['grupos'] = $grupos;
                $registro['id'] = $id;
                $bd->modificarDatosNormas($registro);
            } else  if (isset($_POST['leer'])) {               
                $ca = $bd->buscarPorComunidad($_POST['ca']);
                $registro = $bd->buscarDatosNormas($ca['codigo']);
                $ca = $ca['nombre'];
                $bares = $registro['bares'];
                $toque_queda = $registro['toque_queda'];
                $distancia_interpersonal = $registro['distancia_interpersonal'];
                $grupos = $registro['grupos'];
                $id = $registro['id'];
            }

            echo "
            <form method='post' action='' name='leerDatos'>
                <p><label for='ca'> Comunidad/ciudad Aut.:</label><input type='text' name='ca' id='ca' value='$ca' ";
            
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
                    <form method='get' action=''>
                    <p><label for='bares'>Bares:</label> <input type='checkbox' name='bares' id='bares' value='$bares'/> </p>
                    <p><label for='toque_queda'>Toque de queda:</label> <input type='time' name='toque_queda' id='toque_queda' required value='$toque_queda'/> </p>
                    <p><label for='distancia_interpersonal' >Distancia interpersonal:</label> <input type='double' name='distancia_interpersonal' id='distancia_interpersonal' required value='$distancia_interpersonal'/></p>
                    <p><label for='grupos'>Grupos:</label> <input type='number' name='grupos' id='grupos' required value='$grupos'/> </p>
                        <input type='submit' name='modificar' value='Modificar'>
                        <label for = 'id' hidden>id:</label><input type='text' name='id' id='id' value='$id' hidden/>
                    </form>
                ";
            } 
        ?>
    </section>
</body>
</html>