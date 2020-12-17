<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>   
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Listar</h1>
        <p>Listado de las CCAA</p>
        <?php
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            $informe = $bd->listarCCAA();
        ?>
        <form method="get" action="Ejercicio7.php" name="Inicio">
            <input type="submit" name="inicio" value="Inicio"/>
        </form>
    </section>
</body>
</html>