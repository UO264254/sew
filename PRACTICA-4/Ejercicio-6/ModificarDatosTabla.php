<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alejo" /> 
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>   
<body>
    <section>
        <h1>Modificar</h1>  
        <p>Modificar datos para un registro de pruebas de usabilidad:</p>
        <?php 
        $dniMod="";
        $dniLeer="";
        $nombreMod="";
        $idMod="";
        $apellidosMod="";
        $emailMod="";
        $telefonoMod="";
        $edadMod="";
        $sexoMod="";
        $nivelMod="";
        $tiempoMod="";
        $tareaMod=0;
        $comentariosMod="";
        $mejoraMod="";
        $valoracionMod="";
        if (isset($_GET['id'])) {
            $idMod=$_GET['id'];
        }
        if (isset($_GET['dni'])) {
           $dniMod=$_GET['dni'];
           $dniLeer=$dniMod;
        } 
        if (isset($_GET['nombre'])) {
            $nombreMod=$_GET['nombre'];
         } 
         if (isset($_GET['apellidos'])) {
            $apellidosMod=$_GET['apellidos'];
         }
         if (isset($_GET['email'])) {
            $emailMod=$_GET['email'];
         }
         if (isset($_GET['telefono'])) {
            $telefonoMod=$_GET['telefono'];
         }
         if (isset($_GET['edad'])) {
            $edadMod=$_GET['edad'];
         }
         if (isset($_GET['sexo'])) {
            $sexoMod=$_GET['sexo'];
         }
         if (isset($_GET['nivel'])) {
            $nivelMod=$_GET['nivel'];
         }
         if (isset($_GET['tiempo'])) {
            $tiempoMod=$_GET['tiempo'];
         }
         if (isset($_GET['tarea'])) {
            $tareaMod=(integer) $_GET['tarea'];
         }
         if (isset($_GET['comentarios'])) {
            $comentariosMod=$_GET['comentarios'];
         }
         if (isset($_GET['mejora'])) {
            $mejoraMod=$_GET['mejora'];
         }
         if (isset($_GET['valoracion'])) {
            $valoracionMod=$_GET['valoracion'];
         }
        echo "
            <form method='post' action='Ejercicio6.php'>
                <p>DNI:<input type='text' name='dniLeer' value='$dniLeer'/> </p>
                <input type='submit' name='leer' value='Leer'/>
            </form>
            <form method='post' action='Ejercicio6.php' name='modificarDatos'>
                <p>Nombre: <input type='text' name='nombreMod' required value='$nombreMod' /> </p>
                <p>Apellidos: <input type='text' name='apellidosMod' required value='$apellidosMod' /></p>
                <p>Email: <input type='email' name='emailMod' required value='$emailMod' /></p>
                <p>Telefono: <input type='text' name='telefonoMod' pattern='[0-9]{9}' maxlength='9' value='$telefonoMod' /></p>
                <p>Edad: <input type='number' name='edadMod' min='0' value='$edadMod' /></p>
                <p>Sexo:</p>
                <p>    <input type='radio' name='sexoMod' value='Masculino'";
         if ($sexoMod == "Masculino") { 
            echo "checked='checked'"; 
         }        
         echo "/> Hombre</p>
                <p>    <input type='radio' name='sexoMod' value='Femenino'";
         if ($sexoMod == "Femenino") { 
            echo "checked='checked'"; 
         }         
         echo "/> Mujer</p>
                <p>Nivel: <input type='number' name='nivelMod' min='0' max='10' required value='$nivelMod' /></p>
                <p>Tiempo: <input type='number' name='tiempoMod' min='0' required value='$tiempoMod' /></p>
                <p>Tarea: <input type='checkbox' name='tareaMod' value='$tareaMod' ";
        
        if ($tareaMod == 1) { 
            echo "checked='checked'"; 
        } 
        echo "/> </p>
                <p>Comentarios: <input type='text' name='comentariosMod' value='$comentariosMod' /></p>
                <p>Mejora: <input type='text' name='mejoraMod' value='$mejoraMod' /></p>
                <p>Valoracion: <input type='number' name='valoracionMod'  min='0' max='10' required value='$valoracionMod' /></p>
                <input type='submit' name='modificar' value='Modificar Datos' />
                <input type='text' name='dniMod' value='$dniMod' hidden/>
                <input type='text' name='idMod' value='$idMod' hidden/>
            </form> 
        ";
        ?>
    </section>
</body>
</html>