<!DOCTYPE html>

<html lang="es">

    <head>
        <!--Datos que describen el documento-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>

        <!--Metadatos estándares-->
        <meta name="author" content="Alejo Brandy García-Rovés"/>
    
        <title>Gestión de una base de datos MySQL</title>

        <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />

    </head>

    <body>
        <!--Datos con el contenido que aparece en el navegador-->
        <header>
            <h1>Gestión de una base de datos MySQL</h1>
        </header>
        <?php
            class BaseDatos {
                public function __construct(){
                    
                }

                protected function conectar(){
                    //datos de la base de datos
                    $servername = "localhost";
                    $username = "DBUSER2020";
                    $password = "DBPSWD2020";
                
                    // Conexión al SGBD local con XAMPP con el usuario creado 
                    $db = new mysqli($servername,$username,$password);

                    //comprobamos conexión
                    if($db->connect_error) {
                        exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
                    } else {echo "<p>Conexión establecida con " . $db->host_info . "</p>";}

                    return $db;
                }
                public function crearBD() {
                    
                    $db = $this->conectar();

                    // Se crea la base de datos de trabajo "agenda" utilizando ordenación en español
                    $cadenaSQL = "CREATE DATABASE IF NOT EXISTS agenda COLLATE utf8_spanish_ci";
                    if($db->query($cadenaSQL) === TRUE){
                        echo "<p>Base de datos 'agenda' creada con éxito</p>";
                    } else { 
                        echo "<p>ERROR en la creación de la Base de Datos 'agenda'. Error: " . $db->error . "</p>";
                        exit();
                    }   
                    //cerrar la conexión
                    $db->close();    
                }

                public function crearTabla() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // se puede abrir y seleccionar a la vez
                    //$db = new mysqli($servername,$username,$password,$database);

                    //Crear la tabla persona DNI, Nombre, Apellido
                    $crearTabla = "CREATE TABLE IF NOT EXISTS persona (id INT NOT NULL AUTO_INCREMENT, 
                                dni VARCHAR(9) NOT NULL,
                                nombre VARCHAR(255) NOT NULL, 
                                apellidos VARCHAR(255) NOT NULL,  
                                PRIMARY KEY (id))";
                            
                    if($db->query($crearTabla) === TRUE){
                        echo "<p>Tabla 'persona' creada con éxito </p>";
                    } else { 
                        echo "<p>ERROR en la creación de la tabla persona. Error : ". $db->error . "</p>";
                        exit();
                    }   
                    //cerrar la conexión
                    $db->close();

                }
                public function insertarDatosTabla($dni, $nombre, $apellidos) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);
                    //prepara la sentencia de inserción
                    $consultaPre = $db->prepare("INSERT INTO persona (dni, nombre, apellidos) VALUES (?,?,?)");   
                    
                    //añade los parámetros de la variable Predefinida $_POST
                    // sss indica que se añaden 3 string
                    $consultaPre->bind_param('sss', $dni, $nombre, $apellidos);    

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    //muestra los resultados
                    echo "<p>Filas agregadas: " . $consultaPre->affected_rows . "</p>";

                    $consultaPre->close();

                    //cierra la base de datos
                    $db->close();
                }
                public function buscarDatosTabla($nombre) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM persona WHERE nombre = ?");   
                
                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('s', $nombre);    

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    //Visualización de los resultados de la búsqueda
                    if ($resultado->fetch_assoc()!=NULL) {
                        echo "<p>Las filas de la tabla 'persona' que coinciden con la búsqueda son:</p>";
                        $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                        while($fila = $resultado->fetch_assoc()) {
                            echo "id = " . $fila["id"] . " dni = " . $fila["dni"] . " nombre = ".$fila['nombre']." apellidos = ". $fila['apellidos'] ."</p>"; 
                        }               
                    } else {
                        echo "<p>Búsqueda sin resultados</p>";
                    }
                
                    // cierre de la consulta y la base de datos
                    $consultaPre->close();
                    $db->close();     

                }
                public function modificarDatosTabla() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    //prepara la sentencia de modificación
                    $consultaPre = $db->prepare("UPDATE persona SET nombre= ?, apellidos = ? WHERE columna3 = ?");

                    //añade los parámetros de la variable Predefinida $_POST
                    // sss indica que se añaden 3 string
                    $consultaPre->bind_param('sss', $dni, $nombre, $apellidos);    

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    //muestra los resultados
                    echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";

                    $consultaPre->close();

                    //cierra la base de datos
                    $db->close();

                }
                public function eliminarDatosTabla() {
                    echo 'eliminarDatosTabla';
                }
                public function generarInforme() {
                    echo 'generarInforme';
                }
                public function cargarDatos() {
                    echo 'cargarDatos';
                }
                public function exportarDatos() {
                    echo 'exportarDatos';
                }
            }

            $bd=new BaseDatos();

            if (isset($_GET['crearBD'])) {
                $bd->crearBD();
            } else if (isset($_GET['crearTabla'])) {
                $bd->crearTabla();
            } else if (isset($_GET['modificarDatosTabla'])) {
                $bd->modificarDatosTabla();
            } else if (isset($_GET['eliminarDatosTabla'])) {
                $bd->eliminarDatosTabla();
            } else if (isset($_GET['generarInforme'])) {
                $bd->generarInforme();
            } else if (isset($_GET['cargarDatos'])) {
                $bd->cargarDatos();
            } else if (isset($_GET['exportarDatos'])) {
                $bd->exportarDatos();
            } else if (isset($_POST['dni']) && isset($_POST['nombre']) && isset($_POST['apellidos'])) {
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                
                $bd->insertarDatosTabla($dni, $nombre, $apellidos);
                echo 'Vuelvo con los datos del formulario: '.$_POST['nombre'].$_POST['apellidos'];   
            } else if (isset($_POST['nombreBuscar'])){
                $nombre = $_POST['nombreBuscar'];
                $bd->buscarDatosTabla($nombre);
            }
        ?>
    <!--Menu de navegación principal-->
    <nav>
        <ul>
            <li>
                <a title="Crear Base de Datos"
                tabindex= "1"
                accesskey="C" 
                href="Ejercicio6.php?crearBD">
                            Crear Base de Datos</a>
            </li>
            <li>
                <a title="Crear una tabla"
                tabindex= "2"
                accesskey="R"
                href="Ejercicio6.php?crearTabla">
                            Crear una tabla</a>
            </li>
            <li>
                <a title="Insertar datos en una tabla"
                tabindex= "3"
                accesskey="I"
                href="InsertarDatosTabla.html">
                            Insertar datos en una tabla</a>
            </li>
            <li>
                <a title="Buscar datos en una tabla"
                tabindex= "4"
                accesskey="B"
                href="BuscarDatosTabla.html" >
                            Buscar datos en una tabla</a>
            </li>
            <li>
                <a title="Modificar datos en una tabla"
                tabindex= "5"
                accesskey="M"
                href="Ejercicio6.php?modificarDatosTabla" >
                            Modificar datos en una tabla</a>
            </li>
            <li>
                <a title="Eliminar datos en una tabla"
                tabindex= "6"
                accesskey="E"
                href="Ejercicio6.php?eliminarDatosTabla" >
                            Eliminar datos en una tabla</a>
            </li>
            <li>
                <a title="Generar informe"
                tabindex= "7"
                accesskey="G"
                href="Ejercicio6.php?generarInforme" >
                            Generar informe</a>
            </li>
            <li>
                <a title="Cargar datos desde un archivo en una tabla de la Base de Datos"
                tabindex= "8"
                accesskey="D"
                href="Ejercicio6.php?cargarDatos" >
                            Cargar datos desde un archivo en una tabla de la Base de Datos</a>
            </li>
            <li>
                <a title="Exportar datos a un archivo los datos desde una tabla de la Base de Datos"
                tabindex= "9"
                accesskey="X"
                href="Ejercicio6.php?exportarDatos" >
                            Exportar datos a un archivo los datos desde una tabla de la Base de Datos</a>
            </li>
        </ul>
    </nav>

    <footer>
        <a href="https://validator.w3.org/check?uri=referer">
            <img src="multimedia/HTML5.png" alt=" HTML5 Válido!" /></a>

        <a href=" http://jigsaw.w3.org/css-validator/check/referer ">
            <img src="multimedia/CSS3.png"
            alt="CSS Válido!" height="63" width="64"/></a>
    </footer>
    </body>
</html>