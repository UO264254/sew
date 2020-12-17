<!DOCTYPE html>
<html lang="es">
<head>
    <title>Normas</title>
    <meta charset="utf-8"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Formulario</h1>  
        <p>Insertar datos de normas</p>
        <form method="post" action="" name="insertarDatos">
            <p><label for="ca"> Comunidad/Ciudad Autónoma:</label> <input type="text" name="ca" id="ca" required/> </p>
            <p><label for="bares">Bares:</label> <input type="checkbox" name="bares" id="bares"/> </p>
            <p><label for="toque_queda">Toque de queda:</label> <input type="time" name="toque_queda" id="toque_queda" required/> </p>
            <p><label for="distancia_interpersonal" >Distancia interpersonal:</label> <input type="number"  step="0.01" name="distancia_interpersonal" id="distancia_interpersonal" required/></p>
            <p><label for="grupos">Grupos:</label> <input type="number" name="grupos" id="grupos" required/> </p>
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
                    $registro['codigo'] = $ca['codigo'];
                    if($registro != NULL){
                        $bares = 0;
                        if (isset($_POST['bares'])) {
                            $bares = 1;
                        }
                        $registro['bares'] = $bares;
                        $registro['toque_queda'] = $_POST['toque_queda'];
                        $registro['distancia_interpersonal'] = $_POST['distancia_interpersonal'];
                        $registro['grupos'] = $_POST['grupos'];
                        $bd->insertarDatosNormas($registro);
                    }
                    
                }
                
            }
        ?>
    </section>
</body>
</html>