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
                <p><label for='dniLeer'> DNI:</label><input type='text' name='dniLeer' id='dniLeer' value='$dniLeer'/> </p>
                <input type='submit' name='leer' value='Leer'/>
            </form>
            <form method='post' action='Ejercicio6.php' name='modificarDatos'>
                <p><label for='nombreMod'>Nombre:</label> <input type='text' name='nombreMod' id='nombreMod' required value='$nombreMod' /> </p>
                <p><label for='apellidosMod'>Apellidos:</label> <input type='text' name='apellidosMod' id='apellidosMod' required value='$apellidosMod' /></p>
                <p><label for='emailMod'>Email:</label> <input type='email' name='emailMod' id='emailMod' required value='$emailMod' /></p>
                <p><label for='telefonoMod'>Telefono:</label> <input type='text' name='telefonoMod' id='telefonoMod' pattern='[0-9]{9}' maxlength='9' value='$telefonoMod' /></p>
                <p><label for='edadMod'>Edad:</label> <input type='number' name='edadMod' id='edadMod' min='0' value='$edadMod' /></p>
                <fieldset>
                <p>Sexo:</p>
                <p>    <input type='radio' id ='masculino' name='sexoMod' id='masculino' value='Masculino'";
         if ($sexoMod == "Masculino") { 
            echo "checked='checked'"; 
         }        
         echo "/> <label for = 'masculino'> Hombre </label></p>
                <p>    <input type='radio' name='sexoMod' id='femenino' value='Femenino'";
         if ($sexoMod == "Femenino") { 
            echo "checked='checked'"; 
         }         
         echo "/> <label for = 'femenino'> Mujer</label></p>
         </fieldset>
                <p><label for='nivelMod'>Nivel: </label><input type='number' name='nivelMod' id='nivelMod' min='0' max='10' required value='$nivelMod' /></p>
                <p><label for='tiempoMod'>Tiempo: </label><input type='number' name='tiempoMod' id='tiempoMod' min='0' required value='$tiempoMod' /></p>
                <p><label for='tarea'> Tarea: </label> <input type='checkbox' id='tarea' name='tareaMod' value='$tareaMod' ";
        
        if ($tareaMod == 1) { 
            echo "checked='checked'"; 
        } 
        echo "/> </p>
                <p><label for='comentariosMod'>Comentarios: </label><input type='text' name='comentariosMod' id='comentariosMod' value='$comentariosMod' /></p>
                <p><label for='mejoraMod'>Mejora: </label><input type='text' name='mejoraMod' id='mejoraMod' value='$mejoraMod' /></p>
                <p><label for='valoracionMod'>Valoracion: </label><input type='number' name='valoracionMod' id='valoracionMod' min='0' max='10' required value='$valoracionMod' /></p>
                <input type='submit' name='modificar' value='Modificar Datos' />
                <label for='dniMod' hidden>DniMod:</label> <input type='text' name='dniMod' id='dniMod' value='$dniMod' hidden/>
                <label for='idMod' hidden>IdMod:</label> <input type='text' name='idMod' id='idMod' value='$idMod' hidden/>
            </form> 
        ";
        ?>
    </section>
</body>
</html>