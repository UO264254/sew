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
        <p>Modificar datos de comunidad autónoma:</p>  
       
      
    <?php 
            $ca="";
            $num_hab=0;
            $id=0;
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            if (isset($_POST['leer'])) {               
                $registro = $bd->buscarPorComunidad($_POST['ca']);
                $num_hab = $registro['num_hab'];
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
                    <form method='post' action=''>
                        <p><label for = 'num_hab'>Número de habitantes: </label> <input type='number' name='num_hab' id='num_hab' required value='$num_hab' /> </p>
                        <input type='submit' name='modificar' value='Modificar'>
                        <label for = 'id' hidden>id:</label><input type='text' name='id' id='id' value='$id' hidden/>
                    </form>
                ";
            }
            
            
            if (isset($_POST['modificar'])) {
                $registro['num_hab'] = $_POST['num_hab'];
                $registro['id'] = $_POST['id'];
                $bd->modificarDatosCCAA($registro);
            }
        ?>
    </section>
</body>
</html>