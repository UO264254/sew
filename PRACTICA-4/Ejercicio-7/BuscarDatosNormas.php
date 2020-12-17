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
        <p>Buscar datos de normas:</p>  
        <form method="post" action="" name="buscarDatos">
                <p><label for = "ca">CCAA: </label> <input type="text" name="ca" id="ca" required/> </p> 
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
                if($ca != NULL){
                    $registro = $bd->buscarDatosNormas($ca['codigo']);
                }
                if($registro != NULL){
                    $nbares = $registro['bares'];
                if ($nbares==1) {
                    $bares="Abiertos";
                } else {
                    $bares="Cerrados";
                }
                $toque_queda = $registro['toque_queda'];
                $distancia_interpersonal = $registro['distancia_interpersonal'];
                $grupos = $registro['grupos'];
        
    
                echo "
                    <form method='get' action='Ejercicio7.php'>
                        <p><b>Bares:</b> $bares</p>
                        <p><b>Toque de queda:</b> $toque_queda</p>
                        <p><b>Distancia interpersonal:</b> $distancia_interpersonal</p>
                        <p><b>Grupos:</b> $grupos</p>
                    </form>
                ";
                }
            }
                    
        ?>
    </section>
</body>
</html>