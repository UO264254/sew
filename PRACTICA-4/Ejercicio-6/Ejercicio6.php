<!DOCTYPE html>

<html lang="es">

    <head>
        <!--Datos que describen el documento-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>

        <!--Metadatos estándares-->
        <meta name="author" content="Alejo Brandy García-Rovés"/>
    
        <title>Pruebas de usabilidad</title>

        <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />

    </head>

    <body>
        <!--Datos con el contenido que aparece en el navegador-->
        <header>
            <h1>Pruebas de usabilidad</h1>
        </header>
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
                            Crear tabla PruebasUsabilidad</a>
            </li>
            <li>
                <a title="Insertar datos en una tabla"
                tabindex= "3"
                accesskey="I"
                href="InsertarDatosTabla.html">
                            Insertar</a>
            </li>
            <li>
                <a title="Buscar datos en una tabla"
                tabindex= "4"
                accesskey="B"
                href="BuscarDatosTabla.html" >
                            Buscar</a>
            </li>
            <li>
                <a title="Modificar datos en una tabla"
                tabindex= "5"
                accesskey="M"
                href="ModificarDatosTabla.php" >
                            Modificar</a>
            </li>
            <li>
                <a title="Eliminar datos en una tabla"
                tabindex= "6"
                accesskey="E"
                href="EliminarDatosTabla.html" >
                            Eliminar</a>
            </li>
            <li>
                <a title="Generar informe"
                tabindex= "7"
                accesskey="G"
                href="Ejercicio6.php?generarInforme" >
                            Informe</a>
            </li>
            <li>
                <a title="Cargar datos desde un archivo en una tabla de la Base de Datos"
                tabindex= "8"
                accesskey="D"
                href="Ejercicio6.php?cargarDatos" >
                            Importar</a>
            </li>
            <li>
                <a title="Exportar datos a un archivo los datos desde una tabla de la Base de Datos"
                tabindex= "9"
                accesskey="X"
                href="Ejercicio6.php?exportarDatos" >
                            Exportar</a>
            </li>
        </ul>
    </nav>

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
                    } 

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

                    //Crear la tabla PruebasUsabilidad DNI, Nombre, Apellidos, Email, Teléfono,
                    //Edad, Sexo, Nivel, Tiempo, Tarea (realizada correctamente o no), Comentarios,
                    //Mejora, Valoración
                    $crearTabla = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad (id INT NOT NULL AUTO_INCREMENT, 
                                dni VARCHAR(9) NOT NULL,
                                nombre VARCHAR(255) NOT NULL, 
                                apellidos VARCHAR(255) NOT NULL,
                                email VARCHAR(255) NOT NULL,
                                telefono INT(9) NOT NULL,
                                edad INT(3) NOT NULL,
                                sexo VARCHAR(255) NOT NULL,
                                nivel INT(2) NOT NULL,
                                tiempo INT(9) NOT NULL,
                                tarea BOOLEAN NOT NULL,
                                comentarios VARCHAR(255) NOT NULL,
                                mejora VARCHAR(255) NOT NULL,
                                valoracion INT(2) NOT NULL,
                                PRIMARY KEY (id))";
                            
                    if($db->query($crearTabla) === TRUE){
                        echo "<p>Tabla 'PruebasUsabilidad' creada con éxito </p>";
                    } else { 
                        echo "<p>ERROR en la creación de la tabla persona. Error : ". $db->error . "</p>";
                        exit();
                    }   
                    //cerrar la conexión
                    $db->close();

                }

                public function crearIndices() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $createIndex = "CREATE UNIQUE INDEX idx_dni ON PruebasUsabilidad (dni)";
                    if ($db->query($createIndex)) {
                        echo "<p>Indice idx_dni creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación del idx_dni. Error : ". $db->error . "</p>";
                        exit();
                    }
                        //cerrar la conexión
                     $db->close();

                }
                public function insertarDatosTabla($dni, $nombre, $apellidos,
                                                     $email, $telefono, $edad,
                                                     $sexo, $nivel, $tiempo,
                                                     $tarea, $comentarios, $mejora, $valoracion) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);
                    //prepara la sentencia de inserción
                    $consultaPre = $db->prepare("INSERT INTO PruebasUsabilidad (dni,
                                                                nombre,
                                                                apellidos,
                                                                email,
                                                                telefono,
                                                                edad,
                                                                sexo,
                                                                nivel,
                                                                tiempo,
                                                                tarea,
                                                                comentarios,
                                                                mejora,
                                                                valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");   
                    
                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('ssssiisiiissi', $dni, $nombre, $apellidos,
                                                    $email, $telefono, $edad,
                                                    $sexo, $nivel, $tiempo,
                                                    $tarea, $comentarios, $mejora, $valoracion);    

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if($consultaPre->affected_rows>0){
                        echo "<p>Éxito al insertar</p>";
                    } else{
                        echo "<p>Error al insertar</p>";
                    }

                    $consultaPre->close();

                    //cierra la base de datos
                    $db->close();
                }
                public function buscarDatosTabla($dni) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM PruebasUsabilidad WHERE dni = ?");   
                
                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('s', $dni);    

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    //Visualización de los resultados de la búsqueda
                    if ($resultado->fetch_assoc()!=NULL) {
                        echo "<p>Las filas de la tabla 'PruebasUsabilidad' que coinciden con la búsqueda son:</p>";
                        $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                        echo "<ul>";
                        while($fila = $resultado->fetch_assoc()) {
                            echo "<li>DNI: " . $fila["dni"] . " NOMBRE: ".$fila['nombre']." ". $fila['apellidos'] .
                            "<p>EMAIL: ". $fila['email'] ." TLF: ". $fila['telefono'] ." EDAD: ". $fila['edad'] .
                            " SEXO: ". $fila['sexo'] ."</p><p> NIVEL: ". $fila['nivel'] ." TIEMPO: ". $fila['tiempo'] .
                            " TAREA: ". $fila['tarea'] ."</p><p>COMENTARIOS: ". $fila['comentarios'] .
                            " MEJORA: ". $fila['mejora'] ." VALORACION: ". $fila['valoracion'] ."</p></li>"; 
                        }    
                        echo "</ul>";           
                    } else {
                        echo "<p>Búsqueda sin resultados</p>";
                    }
                
                    // cierre de la consulta y la base de datos
                    $consultaPre->close();
                    $db->close();

                }
                
                public function buscarPorDni($dni) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM PruebasUsabilidad WHERE dni = ?");   
                
                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('s', $dni);    

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    //Visualización de los resultados de la búsqueda
                    if ($resultado->fetch_assoc()!=NULL) {
                        $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                        while($fila = $resultado->fetch_assoc()) {
                            return $fila;                        }               
                    } else {
                        echo "<p>Búsqueda sin resultados</p>";
                        return NULL;
                    }
                
                    // cierre de la consulta y la base de datos
                    $consultaPre->close();
                    $db->close();

                }
                public function modificarDatosTabla($datos) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    //prepara la sentencia de modificación
                    //UPDATE table SET column1 = value1, value2 = value2 WHERE column3 = value3
                    $consultaPre = $db->prepare("UPDATE PruebasUsabilidad SET dni= ? , nombre = ?, apellidos = ?,
                                                                    email =? , telefono=?, edad=?, sexo=?,
                                                                    nivel=?,  tiempo=?, tarea=?, comentarios=?,
                                                                    mejora=?, valoracion=? where id = ?");
                    //añade los parámetros de la variable Predefinida $_POST
                    // sss indica que se añaden 3 string
                    $consultaPre->bind_param('ssssiisiiissii', $datos['dniMod'], $datos['nombreMod'], $datos['apellidosMod'],
                                                    $datos['emailMod'], $datos['telefonoMod'], $datos['edadMod'],
                                                    $datos['sexoMod'], $datos['nivelMod'], $datos['tiempoMod'],
                                                    $datos['tareaMod'], $datos['comentariosMod'], $datos['mejoraMod'],
                                                    $datos['valoracionMod'], $datos['idMod']);    

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if($consultaPre->affected_rows>0){
                        echo "<p>Éxito al modificar</p>";
                    } else{
                        echo "<p>Modificación no realizada</p>";
                    }

                    $consultaPre->close();

                    
                    //cerrar la conexión
                    $db->close();

                }
                public function eliminarDatosTabla($dni) {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    //prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM PruebasUsabilidad WHERE dni = ?");   
                
                    //obtiene los parámetros de la variable predefinida $_POST
                    // s indica que dni es un string
                    $consultaPre->bind_param('s', $dni);    

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //guarda los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    //Visualización de los resultados de la búsqueda
                    if ($resultado->fetch_assoc()!=NULL) {
                        echo "<p>Las filas de la tabla 'persona' que van a ser eliminadas son:</p>";
                        $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                        while($fila = $resultado->fetch_assoc()) {
                            echo "id = " . $fila["id"] . " dni = " . $fila["dni"] . " nombre = ".$fila['nombre']." apellidos = ". $fila['apellidos'] .
                            " email = ". $fila['email'] ." telefono = ". $fila['telefono'] ." edad = ". $fila['edad'] .
                            " sexo = ". $fila['sexo'] ." nivel = ". $fila['nivel'] ." tiempo = ". $fila['tiempo'] .
                            " tarea = ". $fila['tarea'] ." comentarios = ". $fila['comentarios'] .
                            " mejora = ". $fila['mejora'] ." valoracion = ". $fila['valoracion'] ."</p>"; 
                        } 
                    echo "</ul>";

                    //Realiza el borrado
                    //prepara la sentencia SQL de borrado
                    $consultaPre = $db->prepare("DELETE FROM PruebasUsabilidad WHERE dni = ?");   
                    //obtiene los parámetros de la variable almacenada
                    $consultaPre->bind_param('s', $dni);    
                    //ejecuta la consulta
                    $consultaPre->execute();
                    // cierra la consulta
                    $consultaPre->close();
                    echo "<p>Borrados los datos</p>";               
                    } 
                    else {
                        echo "<p>Búsqueda sin resultados. No se ha borrado nada</p>";
                    }

                    //consultar la tabla PruebasUsabilidad
                    $resultado =  $db->query('SELECT * FROM PruebasUsabilidad');
                    
                    // compruebo los datos recibidos     
                    if ($resultado->num_rows > 0) {
                        // Mostrar los datos en un lista
                        echo "<p>Los datos en la tabla 'PruebasUsabilidad' son: </p>";
                        echo "<p>". 'id' . " - " . 'dni' ." - ". 'nombre' ." - ". 'apellidos' . " - " .
                        'email'. " - " .'telefono'. " - " .'edad'. " - " .'sexo'. " - " .'nivel' . " - "
                        .'tiempo'. " - " .'tarea'. " - " .'comentarios'. " - " .'mejora'. " - " .'validacion'."</p>";
                        while($fila = $resultado->fetch_assoc()) {
                            echo $fila["id"] .  " - " . $fila["dni"] . " - " .$fila['nombre']. " - ". $fila['apellidos']. " - " .
                             $fila['email']. " - " . $fila['telefono']. " - " . $fila['edad']. " - " .
                             $fila['sexo']. " - " . $fila['nivel']. " - " . $fila['tiempo']. " - " .
                             $fila['tarea']. " - " . $fila['comentarios']. " - " 
                            . $fila['mejora']. " - " . $fila['valoracion']."</p>";
                        }
                    } else {
                        echo "<p>Tabla vacía</p>";
                        }          
                    //cerrar la conexión
                    $db->close();

                }
                public function generarInforme() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // prepara la consulta de Edad media
                    $consultaMedia = $db->prepare("SELECT round(AVG(edad),2) AS AverageEdad,
                                                            round(AVG(nivel),2) AS AverageNivel,
                                                            round(AVG(tiempo),2) AS AverageTiempo,
                                                            round(AVG(valoracion),2) AS AverageValoracion,
                                                            round(COUNT(*)) AS NumRegistros
                                                   FROM PruebasUsabilidad");
                    
                    
                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    //edad media
                    $consultaMedia->execute();
                    $resultado = $consultaMedia->get_result();
                    $fila = $resultado->fetch_assoc();
                    $edadMedia= $fila['AverageEdad'];
                    $nivelMedio= $fila['AverageNivel'];
                    $tiempoMedio= $fila['AverageTiempo'];
                    $valoracionMedia= $fila['AverageValoracion'];
                    $nRegistros=$fila['NumRegistros'];
                    $consultaMedia->close();


                    //frecuencia
                    $resultado =$db->query("SELECT sexo as sexo, count(*) as total from PruebasUsabilidad group by sexo");
                    $frecuencia="";
                    while ($fila = $resultado->fetch_assoc()) {
                        $percen= round(((double) $fila['total'])*100/$nRegistros, 2);
                        $frecuencia.=$fila['sexo'].'='.$percen."%"." ";
                    }

                    echo $frecuencia;

                    //tarea
                    $resultado =$db->query("SELECT tarea, count(*) as total from PruebasUsabilidad  where tarea = '1' group by tarea");
                    $fila = $resultado->fetch_assoc();
                    $tarea= round($fila['total']*100/$nRegistros,2).'%';                   

                    $db->close();

                    header('location: Informe.php?edadMedia='.$edadMedia.
                                                    '&nivelMedio='.$nivelMedio.
                                                    '&tiempoMedio='.$tiempoMedio.
                                                    '&valoracionMedia='.$valoracionMedia.
                                                    '&frecuenciaSexo='.$frecuencia.
                                                    '&tarea='.$tarea);
                  
                }
                public function cargarDatos() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    $filename = 'DATA_importar.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
                    {
                        //prepara la sentencia de inserción
                        $consultaPre = $db->prepare("INSERT INTO PruebasUsabilidad (dni,
                                                                                nombre,
                                                                                apellidos,
                                                                                email,
                                                                                telefono,
                                                                                edad,
                                                                                sexo,
                                                                                nivel,
                                                                                tiempo,
                                                                                tarea,
                                                                                comentarios,
                                                                                mejora,
                                                                                valoracion)
                                                     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");   
                    
                        //añade los parámetros de la variable Predefinida $_POST
                        $consultaPre->bind_param('ssssiisiiissi', $data[0], $data[1], $data[2],
                        $data[3], $data[4], $data[5], $data[6], $data[7],  $data[8], $data[9],
                        $data[10],$data[11], $data[12]);     

                        //ejecuta la sentencia
                        $consultaPre->execute();

                        $consultaPre->close();
                        
                        
                    }
                
                    fclose($handle);
                    echo "Importación exitosa";
                       
                    
                    $db->close();
                   
                }
                public function exportarDatos() {
                    $db = $this->conectar();
                    $database = "agenda";
                    
                    //selecciono la base de datos AGENDA para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM PruebasUsabilidad");

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    $fp = fopen('pruebasUsabilidad.csv', 'w');

                    foreach ($resultado as $line) {
                        fputcsv($fp, $line);
                    }

                    echo "!Exportación exitosa!";

                    fclose($fp);
                }
            }

            $bd=new BaseDatos();
            
            if (isset($_GET['crearBD'])) {
                $bd->crearBD();
            } else if (isset($_GET['crearTabla'])) {
                $bd->crearTabla();
                $bd->crearIndices();
            }  else if (isset($_GET['generarInforme'])) {
                $bd->generarInforme();
            } else if (isset($_GET['cargarDatos'])) {
                $bd->cargarDatos();
            } else if (isset($_GET['exportarDatos'])) {
                $bd->exportarDatos();
            } else if (isset($_POST['dni'])) {
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $edad = $_POST['edad'];
                $sexo = $_POST['sexo'];
                $nivel = $_POST['nivel'];
                $tiempo = $_POST['tiempo'];
                $tarea = 0;
                if (isset($_POST['tarea'])) {
                    $tarea = 1;
                }
                $comentarios = $_POST['comentarios'];
                $mejora = $_POST['mejora'];
                $valoracion = $_POST['valoracion'];
                
                $bd->insertarDatosTabla($dni, $nombre, $apellidos,
                                $email, $telefono, $edad,
                                $sexo, $nivel, $tiempo,
                                $tarea, $comentarios, $mejora, $valoracion);
                   
            } else if (isset($_POST['dniMod']) && isset($_POST['nombreMod']) && isset($_POST['apellidosMod'])) {
                
                $bd->modificarDatosTabla($_POST);
            
            } else if (isset($_POST['dniBuscar'])){
                $dni = $_POST['dniBuscar'];
                $bd->buscarDatosTabla($dni);

            } else if (isset($_POST['dniEliminar'])){
                $dni = $_POST['dniEliminar'];
                $bd->eliminarDatosTabla($dni);

            } else if (isset($_POST['leer'])) {
                $resultado=$bd->buscarPorDni($_POST['dniLeer']);
                echo $resultado['id'];
                header('location: ModificarDatosTabla.php?id='.$resultado['id'].'&dni='.$resultado['dni'].'&nombre='.$resultado['nombre'].'&apellidos='.$resultado['apellidos']
                .'&email='.$resultado['email'].'&telefono='.$resultado['telefono'].'&edad='.$resultado['edad']
                .'&sexo='.$resultado['sexo'].'&nivel='.$resultado['nivel'].'&tiempo='.$resultado['tiempo']
                .'&tarea='.$resultado['tarea'].'&comentarios='.$resultado['comentarios'].'&mejora='.$resultado['mejora']
                .'&valoracion='.$resultado['valoracion']);

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