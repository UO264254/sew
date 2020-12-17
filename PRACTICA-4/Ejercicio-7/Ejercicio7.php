<!DOCTYPE html>

<html lang="es">

    <head>
        <!--Datos que describen el documento-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>

        <!--Metadatos estándares-->
        <meta name="author" content="Alejo Brandy García-Rovés"/>
    
        <title>Ejercicio Temática Libre</title>

        <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />

    </head>

    <body>
        <!--Datos con el contenido que aparece en el navegador-->
        <header>
            <h1>Ejercicio Temática Libre</h1>
        </header>
         <!--Menu de navegación principal-->
    <nav>
        <ul>
            <li>Operaciones DDL
                <ul>
                    <li>
                        <a title="Crear Base de Datos"
                        tabindex= "1"
                        accesskey="C" 
                        href="Ejercicio7.php?crearBD">
                                    Crear Base de Datos</a>
                    </li>
                    <li>
                        <a title="Crear una tabla"
                        tabindex= "2"
                        accesskey="R"
                        href="Ejercicio7.php?crearTablas">
                                    Crear tablas</a>
                    </li>
                </ul>
            </li>
            
            <li>Comunidades/ciudades autónomas
                <ul>
                    <li>
                        <a title="Importar datos CCAA"
                        tabindex= "3"
                        accesskey="I"
                        href="Ejercicio7.php?importarDatosCCAA" >
                                    Importar</a>
                    </li>
                    <li>
                        <a title="Exportar datos CCAA"
                        tabindex= "4"
                        accesskey="E"
                        href="Ejercicio7.php?exportarDatosCCAA" >
                                    Exportar</a>
                    </li>
                    <li>
                        <a title="Modificar datos CCAA"
                        tabindex= "5"
                        accesskey="M"
                        href="ModificarDatosCCAA.php" >
                                    Modificar</a>
                    </li>
                    <li>
                        <a title="Listar CCAA"
                        tabindex= "6"
                        accesskey="L"
                        href="ListarDatosCCAA.php" >
                                    Listar</a>
                    </li>

                </ul>
            </li>
            
            <li>Datos COVID
                <ul>
                    <li>
                        <a title="Importar datos Covid_dia"
                        tabindex= "7"
                        accesskey="O"
                        href="Ejercicio7.php?importarDatosCovidDia" >
                                    Importar</a>
                    </li>
                    <li>
                        <a title="Exportar datos Covid_dia"
                        tabindex= "8"
                        accesskey="X"
                        href="Ejercicio7.php?exportarDatosCovidDia" >
                                    Exportar</a>
                    </li>
                    <li>
                        <a title="Insertar datos COVID hoy"
                        tabindex= "9"
                        accesskey="S"
                        href="InsertarDatosCOVID.php">
                                    Insertar</a>
                    </li>
                    <li>
                        <a title="Buscar datos COVID comunidad"
                        tabindex= "10"
                        accesskey="B"
                        href="BuscarDatosCOVID.php" >
                                    Buscar</a>
                    </li>
                    <li>
                        <a title="Modificar datos COVID"
                        tabindex= "11"
                        accesskey="D"
                        href="ModificarDatosCOVID.php" >
                                    Modificar</a>
                    </li>
                    <li>
                        <a title="Eliminar datos COVID comunidad"
                        tabindex= "12"
                        accesskey="A"
                        href="EliminarDatosCOVID.php" >
                                    Eliminar</a>
                    </li>
                    <li>
                        <a title="Últimos datos COVID España"
                        tabindex= "13"
                        accesskey="F"
                        href="Informe.php" >
                                    Informe</a>
                    </li>
                </ul>
            </li>
            
            <li>Datos Normas
                <ul>
                    <li>
                        <a title="Importar datos Normas"
                        tabindex= "14"
                        accesskey="T"
                        href="Ejercicio7.php?importarDatosNormas" >
                                    Importar</a>
                    </li>
                    <li>
                        <!-- Sin accesskey, no hay más disponibles-->
                        <a title="Exportar datos Normas"
                        tabindex= "15"
                        href="Ejercicio7.php?exportarDatosNormas" >
                                    Exportar</a>
                    </li>
                
                    <li>
                        <!-- Sin accesskey, no hay más disponibles-->
                        <a title="Insertar datos Normas"
                        tabindex= "16"
                        href="InsertarDatosNormas.php">
                                    Insertar</a>
                    </li>
                
                    <li>
                        <a title="Buscar datos Normas"
                        tabindex= "17"
                        accesskey="U"
                        href="BuscarDatosNormas.php" >
                                    Buscar</a>
                    </li>
                    <li>
                        <!-- Sin accesskey, no hay más disponibles-->
                        <a title="Modificar datos Normas"
                        tabindex= "18"
                        href="ModificarDatosNormas.php" >
                                    Modificar</a>
                    </li>
                    <li>
                        <!-- Sin accesskey, no hay más disponibles-->
                        <a title="Eliminar datos Normas"
                        tabindex= "19"
                        href="EliminarDatosNormas.php" >
                                    Eliminar</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

        <?php
        
            require 'BaseDatos.php';
            $bd=new BaseDatos();
            
            if (isset($_GET['crearBD'])) {
                $bd->crearBD();
            } else if (isset($_GET['crearTablas'])) {
                $bd->crearTablas();
                $bd->crearIndices();
                $bd->addForeignKeys();
            } else if (isset($_GET['importarDatosCCAA'])) {
                $bd->importarDatosCCAA();
            } else if (isset($_GET['exportarDatosCCAA'])) {
                $bd->exportarDatosCCAA();
            } else if (isset($_GET['importarDatosCovidDia'])) {
                $bd->importarDatosCovidDia();
            } else if (isset($_GET['exportarDatosCovidDia'])) {
                $bd->exportarDatosCovidDia();
            } else if (isset($_GET['importarDatosNormas'])) {
                $bd->importarDatosNormas();
            } else if (isset($_GET['exportarDatosNormas'])) {
                $bd->exportarDatosNormas();
            } 
                        
        ?>
   
    <footer>
        <a href="https://validator.w3.org/check?uri=referer">
            <img src="multimedia/HTML5.png" alt=" HTML5 Válido!" /></a>

        <a href=" http://jigsaw.w3.org/css-validator/check/referer ">
            <img src="multimedia/CSS3.png"
            alt="CSS Válido!" height="63" width="64"/></a>
    </footer>
    </body>
</html>