<!DOCTYPE html>
<html lang="es">
<head>
    <title>Informe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>   
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Informe</h1>  
        <?php 
        $edadMedia="";
        $frecuencia="";
        $nivelMedio="";
        $tiempoMedio="";
        $valoracionMedia="";
        $frecuenciaSexo="";
        $tarea="";
        if (isset($_GET['edadMedia'])) {
            $edadMedia=$_GET['edadMedia'];
        } if (isset($_GET['frecuencia'])) {
            $frecuencia=$_GET['frecuencia'];
        } if (isset($_GET['nivelMedio'])) {
            $nivelMedio=$_GET['nivelMedio'];
        } if (isset($_GET['tiempoMedio'])) {
            $tiempoMedio=$_GET['tiempoMedio'];
        } if (isset($_GET['valoracionMedia'])) {
            $valoracionMedia=$_GET['valoracionMedia'];
        } if (isset($_GET['frecuenciaSexo'])) {
            $frecuenciaSexo=$_GET['frecuenciaSexo'];
        } if (isset($_GET['tarea'])) {
            $tarea=$_GET['tarea'];
        }
        
        echo "
            <form method='get' action='Ejercicio6.php'>
                <p>Edad media: $edadMedia</p>
                <p>Frecuencia: $frecuenciaSexo</p>
                <p>Nivel medio: $nivelMedio</p>
                <p>Tiempo medio: $tiempoMedio</p>
                <p>Valoración media: $valoracionMedia</p>
                <p>Tarea: $tarea</p>
        ";
        ?>
    </section>
</body>
</html>