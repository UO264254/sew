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
            <li>
                <a title="Importar datos CCAA"
                tabindex= "3"
                accesskey="I"
                href="Ejercicio7.php?cargarDatosCCAA" >
                            Importar Datos CCAA</a>
            </li>
            <li>
                <a title="Importar datos Covid_dia"
                tabindex= "4"
                accesskey="M"
                href="Ejercicio7.php?cargarDatosCovidDia" >
                            Importar Datos Casos de Covid</a>
            </li>
            <li>
                <a title="Importar datos Normas"
                tabindex= "5"
                accesskey="P"
                href="Ejercicio7.php?cargarDatosNormas" >
                            Importar Datos Normas</a>
            </li>
            <li>
                <a title="Generar informe"
                tabindex= "6"
                accesskey="N"
                href="Ejercicio7.php?generarInforme" >
                            Informe</a>
            </li>
            <!--<li>
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
            </li>-->
            <!--<li>
                <a title="Exportar datos a un archivo los datos desde una tabla de la Base de Datos"
                tabindex= "9"
                accesskey="X"
                href="Ejercicio6.php?exportarDatos" >
                            Exportar</a>
            </li>-->
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

                    // Se crea la base de datos de trabajo "covid" utilizando ordenación en español
                    $cadenaSQL = "CREATE DATABASE IF NOT EXISTS covid COLLATE utf8_spanish_ci";
                    if($db->query($cadenaSQL) === TRUE){
                        echo "<p>Base de datos 'covid' creada con éxito</p>";
                    } else { 
                        echo "<p>ERROR en la creación de la Base de Datos 'covid'. Error: " . $db->error . "</p>";
                        exit();
                    }   
                    //cerrar la conexión
                    $db->close();    
                }

                public function crearTablas() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    //Crear la tabla CCAA con CODIGO, NOMBRE, NUM_HAB
                    $crearTablaCCAA = "CREATE TABLE IF NOT EXISTS CCAA (id INT NOT NULL AUTO_INCREMENT, 
                                codigo INT(2) NOT NULL,
                                nombre VARCHAR(255) NOT NULL, 
                                num_hab INT(9) NOT NULL,
                                PRIMARY KEY (id))";
                            
                    if($db->query($crearTablaCCAA) === TRUE){
                        echo "<p>Tabla 'CCAA' creada con éxito </p>";
                    } else { 
                        echo "<p>ERROR en la creación de la tabla CCAA. Error : ". $db->error . "</p>";
                        exit();
                    }
                    
                    //Crear la tabla COVID_DIA con CODIGO, FECHA, CASOS_NUEVOS, PRUEBAS, FALLECIDOS,
                    //CURADOS, HOSPITAL_PLANTA, UCI 
                    $crearTablaCOVIDDIA = "CREATE TABLE IF NOT EXISTS COVID_DIA (id INT NOT NULL AUTO_INCREMENT, 
                                codigo INT(2) NOT NULL,
                                fecha DATE NOT NULL, 
                                casos_nuevos INT(9) NOT NULL,
                                pruebas INT(9) NOT NULL,
                                fallecidos INT(9) NOT NULL,
                                curados INT(9) NOT NULL,
                                hospital_planta INT(9) NOT NULL,
                                uci INT(9) NOT NULL,
                                PRIMARY KEY (id))";
                            
                    if($db->query($crearTablaCOVIDDIA) === TRUE){
                        echo "<p>Tabla 'COVID_DIA' creada con éxito </p>";
                    } else { 
                        echo "<p>ERROR en la creación de la tabla COVID_DIA. Error : ". $db->error . "</p>";
                        exit();
                    }

                    //Crear la tabla NORMAS con CODIGO, BARES, TOQUE_QUEDA, DISTANCIA_INTERPERSONAL, GRUPOS
                    $crearTablaNormas = "CREATE TABLE IF NOT EXISTS NORMAS (id INT NOT NULL AUTO_INCREMENT, 
                                codigo INT(2) NOT NULL,
                                bares BOOLEAN NOT NULL, 
                                toque_queda TIME NOT NULL,
                                distancia_interpersonal FLOAT(3) NOT NULL,
                                grupos int(2) NOT NULL,
                                PRIMARY KEY (id))";
                            
                    if($db->query($crearTablaNormas) === TRUE){
                        echo "<p>Tabla 'NORMAS' creada con éxito </p>";
                    } else { 
                        echo "<p>ERROR en la creación de la tabla NORMAS. Error : ". $db->error . "</p>";
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

                    //muestra los resultados
                    echo "<p>Filas agregadas: " . $consultaPre->affected_rows . "</p>";

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
                public function buscarPorComunidad($nombreCCAA) {
                    echo "buscarPorComunidad ".$nombreCCAA;
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM CCAA WHERE nombre = ?");   
                
                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('s', $nombreCCAA);    

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

                    //muestra los resultados
                    echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";

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
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    /*$consultaMedia = $db->prepare("SELECT round(AVG(edad),2) AS AverageEdad,
                                                            round(AVG(nivel),2) AS AverageNivel,
                                                            round(AVG(tiempo),2) AS AverageTiempo,
                                                            round(AVG(valoracion),2) AS AverageValoracion,
                                                            round(COUNT(*)) AS NumRegistros
                                                   FROM PruebasUsabilidad");*/

                    $consulta = $db->query("SELECT *
                                            FROM covid_dia 
                                            WHERE fecha = 
                                                        (SELECT MAX(fecha)
                                                        FROM covid_dia)");
                    $casos_nuevos = 0;
                    $pruebas = 0;
                    $fallecidos = 0;
                    $curados = 0;
                    $hospital_planta = 0;
                    $uci = 0;
                    
                    while ($fila = $consulta->fetch_assoc()) {
                        $casos_nuevos+= ((int) $fila['casos_nuevos']);
                        $pruebas+= ((int) $fila['pruebas']);
                        $fallecidos+= ((int) $fila['fallecidos']);
                        $curados+= ((int) $fila['curados']);
                        $hospital_planta+= ((int) $fila['hospital_planta']);
                        $uci+= ((int) $fila['uci']);
                        $fecha = $fila['fecha'];
                    }

                    $positividad = round(((double)$casos_nuevos*100/$pruebas),2).'%';
                    

                    $db->close();
                    
                    
                    header('location: Informe.php?fecha='.$fecha.
                                                    '&casos_nuevos='.$casos_nuevos.
                                                    '&pruebas='.$pruebas.
                                                    '&positividad='.$positividad.
                                                    '&fallecidos='.$fallecidos.
                                                    '&curados='.$curados.
                                                    '&hospital_planta='.$hospital_planta.
                                                    '&uci='.$uci);
                    
                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    //edad media
                    /*$consultaMedia->execute();
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

                    echo $frecuencia;*/

                    //tarea
                    /*$resultado =$db->query("SELECT tarea, count(*) as total from PruebasUsabilidad  where tarea = '1' group by tarea");
                    $fila = $resultado->fetch_assoc();
                    $tarea= round($fila['total']*100/$nRegistros,2).'%';*/         

                    

                    /*header('location: Informe.php?edadMedia='.$edadMedia.
                                                    '&nivelMedio='.$nivelMedio.
                                                    '&tiempoMedio='.$tiempoMedio.
                                                    '&valoracionMedia='.$valoracionMedia.
                                                    '&frecuenciaSexo='.$frecuencia.
                                                    '&tarea='.$tarea);*/
                    
                    
                  
                }
                public function cargarDatosCCAA() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'dataCCAA.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
                    {
                        //prepara la sentencia de inserción
                        $consultaPre = $db->prepare("INSERT INTO CCAA (codigo, nombre, num_hab)
                                                     VALUES (?,?,?)");  
                    
                        //añade los parámetros de la variable Predefinida $_POST
                        $consultaPre->bind_param('isi', $data[0], $data[1], $data[2]);     

                        //ejecuta la sentencia
                        $consultaPre->execute();

                        $consultaPre->close();
                        
                    }
                
                    fclose($handle);
                    echo "Importación exitosa!";
                       
                    
                    $db->close();
                   
                }
                public function cargarDatosCovidDia() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'dataCovidDia.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
                    {
                        //prepara la sentencia de inserción
                        $consultaPre = $db->prepare("INSERT INTO COVID_DIA (codigo, fecha, casos_nuevos,
                                                                            pruebas, fallecidos, curados, hospital_planta, uci)
                                                     VALUES (?,?,?,?,?,?,?,?)");  
                    
                        //añade los parámetros de la variable Predefinida $_POST
                        $consultaPre->bind_param('isiiiiii', $data[0], $data[1], $data[2],
                                                                    $data[3], $data[4], $data[5], $data[6], $data[7]);     

                        //ejecuta la sentencia
                        $consultaPre->execute();

                        $consultaPre->close();
                        
                    }
                
                    fclose($handle);
                    echo "Importación exitosa!";
                       
                    
                    $db->close();
                   
                }
                public function cargarDatosNormas() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'dataNormas.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
                    {
                        //prepara la sentencia de inserción
                        $consultaPre = $db->prepare("INSERT INTO NORMAS (codigo, bares, toque_queda,
                                                                     distancia_interpersonal, grupos)
                                                     VALUES (?,?,?,?,?)");  
                    
                        //añade los parámetros de la variable Predefinida $_POST
                        $consultaPre->bind_param('iisdi', $data[0], $data[1], $data[2], $data[3], $data[4]);     

                        //ejecuta la sentencia
                        $consultaPre->execute();

                        $consultaPre->close();
                        
                    }
                
                    fclose($handle);
                    echo "Importación exitosa!";
                       
                    
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
            } else if (isset($_GET['crearTablas'])) {
                $bd->crearTablas();
            }  else if (isset($_GET['generarInforme'])) {
                $bd->generarInforme();
            } else if (isset($_GET['cargarDatosCCAA'])) {
                $bd->cargarDatosCCAA();
            } else if (isset($_GET['cargarDatosCovidDia'])) {
                $bd->cargarDatosCovidDia();
            } else if (isset($_GET['cargarDatosNormas'])) {
                $bd->cargarDatosNormas();
            } else if (isset($_GET['exportarDatos'])) {
                $bd->exportarDatos();
            } else if (isset($_POST['leerComunidad'])) {
                echo "buscarPorComunidad ".$_POST['nombreComunidad'];
                $resultado=$bd->buscarPorComunidad($_POST['nombreComunidad']);
                echo $resultado['nombre'];
                header('location: Informe.php?id='.$resultado['id'].'&codigo='.$resultado['codigo']
                                                .'&nombre='.$resultado['nombre'].'&num_hab='.$resultado['num_hab']);
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
            
            } else if (isset($_POST['nombreComunidad'])) {
                
                $bd->generarInforme($_POST);
            
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