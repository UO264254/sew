<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Información meteorológica</title>
<link rel="stylesheet" href="Ejercicio4.css"/>

</head>
<body>
      <?php
         session_start();
         $codigoPhp=implode('', file('InformacionMeteo.php'));
      ?>
      <?php 
         try{
            eval($codigoPhp);
         }catch(Throwable $e){
            echo'Error en la expresión, vuelve a intentarlo';
         }
      ?> 
<footer>
    <a href="http://validator.w3.org/check/referer" hreflang="es-us"> 
        <img src="imagenes/HTML5.png" alt="¡HTML5 válido!"/></a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="imagenes/CSS3.png" alt="¡CSS válido!" /></a></footer>

</body>
</html>
