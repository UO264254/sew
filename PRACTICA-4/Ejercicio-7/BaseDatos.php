<?php class BaseDatos {
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
                public function crearIndices() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $createIndex = "CREATE UNIQUE INDEX idx_cca_codigo ON CCAA (codigo)";
                    if ($db->query($createIndex)) {
                        echo "<p>Indice idx_cca_codigo creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación del idx_cca_codigo. Error : ". $db->error . "</p>";
                        exit();
                    }
                    $createIndex = "CREATE UNIQUE INDEX idx_normas_codigo ON NORMAS (codigo)";
                    if ($db->query($createIndex)) {
                        echo "<p>Indice idx_normas_codigo creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación del idx_normas_codigo. Error : ". $db->error . "</p>";
                        exit();
                    }
                    $createIndex = "CREATE UNIQUE INDEX idx_covid_dia ON COVID_DIA (codigo, fecha)";
                    if ($db->query($createIndex)) {
                        echo "<p>Indice idx_covid_dia creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación del idx_covid_dia. Error : ". $db->error . "</p>";
                        exit();
                    }
                     //cerrar la conexión
                     $db->close();

                }
                public function addForeignKeys() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $foreignKey = "ALTER TABLE NORMAS
                            ADD FOREIGN KEY (codigo) REFERENCES CCAA(codigo);";
                    if ($db->query($foreignKey)) {
                        echo "<p>ForeignKey NORMAS.codigo creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación de foreingKey NORMAS.codigo . Error : ". $db->error . "</p>";
                        exit();
                    }
                    $foreignKey = "ALTER TABLE COVID_DIA
                    ADD FOREIGN KEY (codigo) REFERENCES CCAA(codigo);";
                    if ($db->query($foreignKey)) {
                        echo "<p>ForeignKey COVID_DIA.codigo creado con éxito";
                    } else {
                        echo "<p>ERROR en la creación de foreingKey COVID_DIA.codigo . Error : ". $db->error . "</p>";
                        exit();
                    }
                     //cerrar la conexión
                     $db->close();
                }
                public function insertarDatosCOVID($registro) {
                    $db = $this->conectar();
                    $database = "covid";

                    //selecciono la base de datos covid para utilizarla
                    $db->select_db($database);
                    //prepara la sentencia de inserción
                    
                    error_log($registro['codigo']."-".
                    $registro['fecha']."-".
                    $registro['casos_nuevos']."-".
                    $registro['pruebas']."-".
                    $registro['fallecidos']."-".
                    $registro['curados']."-".
                    $registro['hospital_planta']."-".
                    $registro['uci']);

                    $consultaPre = $db->prepare("INSERT INTO COVID_DIA (
                                            codigo,
                                            fecha, 
                                            casos_nuevos,
                                            pruebas,
                                            fallecidos,
                                            curados,
                                            hospital_planta,
                                            uci )
                                            VALUES (?,?,?,?,?,?,?,?)");  
                                            

                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('isiiiiii', 
                        $registro['codigo'],
                        $registro['fecha'],
                        $registro['casos_nuevos'],
                        $registro['pruebas'],
                        $registro['fallecidos'],
                        $registro['curados'],
                        $registro['hospital_planta'],
                        $registro['uci'] );    

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if ($consultaPre->affected_rows>0) {
                        //muestra los resultados
                        echo "<p>Éxito en la operación de insercción. </p>";
                    } else {
                        echo "<p>Error en la operación de insercción.</p>";
                    }

                    $consultaPre->close();

                    //cierra la base de datos
                    $db->close();
                }

                public function insertarDatosNormas($registro) {
                    $db = $this->conectar();
                    $database = "covid";

                    //selecciono la base de datos covid para utilizarla
                    $db->select_db($database);
                    //prepara la sentencia de inserción
                    
                    error_log($registro['codigo']."-".
                    $registro['bares']."-".
                    $registro['toque_queda']."-".
                    $registro['distancia_interpersonal']."-".
                    $registro['grupos']);
                   

                    //prepara la sentencia de inserción
                    $consultaPre = $db->prepare("INSERT INTO NORMAS (codigo, bares, toque_queda,
                                                    distancia_interpersonal, grupos)
                                                VALUES (?,?,?,?,?)");    
                                            

                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('iisdi', 
                        $registro['codigo'],
                        $registro['bares'],
                        $registro['toque_queda'],
                        $registro['distancia_interpersonal'],
                        $registro['grupos']);


                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if ($consultaPre->affected_rows>0) {
                        //muestra los resultados
                        echo "<p>Éxito en la operación de insercción. </p>";
                    } else {
                        echo "<p>Error en la operación de insercción.</p>";
                    }

                    $consultaPre->close();

                    //cierra la base de datos
                    $db->close();
                }
                
                public function buscarPorComunidad($nombreCCAA) {
                    error_log("buscarPorComunidad ".$nombreCCAA);
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $nombreCCAA='%'.$nombreCCAA.'%';

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM CCAA WHERE nombre LIKE ?");   
                
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
                        echo "<p>Búsqueda por Comunidad sin resultados</p>";
                        return NULL;
                    }
                
                    // cierre de la consulta y la base de datos
                    $consultaPre->close();
                    $db->close();

                }

                public function buscarDatosCovid($ca, $fecha) {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    error_log("bucarDatosCovid: ca=".$ca." fecha=".$fecha);
                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM  COVID_DIA  
                                                            WHERE codigo = ? AND fecha=?");   

                    if ($fecha==NULL or empty($fecha)) {
                        $consulta = $db->query("SELECT *
                                                FROM covid_dia 
                                                        WHERE fecha = 
                                                            (SELECT MAX(fecha)
                                                            FROM covid_dia)");
                        $fila = $consulta->fetch_assoc();
                        $fecha = $fila['fecha'];

                    }

                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('is', $ca, $fecha);    

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

                public function buscarDatosNormas($ca) {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    error_log("buscarDatosCovid: ca=".$ca);
                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM  NORMAS  
                                                            WHERE codigo = ?");   
                
                    // obtiene los parámetros de la variable predefinida $_POST
                    // s indica que se le pasa un string
                    $consultaPre->bind_param('i', $ca);    

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

                public function eliminarDatosCovid($ca, $fecha) {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    error_log("eliminar: ca=".$ca." fecha=".$fecha);

                    //Realiza el borrado
                    //prepara la sentencia SQL de borrado
                    $consultaPre = $db->prepare("DELETE FROM COVID_DIA 
                                                        WHERE codigo = ? AND fecha=?");   
                    // obtiene los parámetros de la variable predefinida $_POST
                    $consultaPre->bind_param('is', $ca, $fecha);       
                    //ejecuta la consulta
                    $consultaPre->execute();
                    if($consultaPre->affected_rows==0) {
                        echo "<p>Búsqueda sin resultados. No se ha borrado nada</p>";
                    } else {
                        echo "<p>Registro eliminado.</p>";
                    }
                
                    $consultaPre->close();
                    

                }

                public function eliminarDatosNormas($ca) {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    error_log("eliminar: ca=".$ca);

                    //Realiza el borrado
                    //prepara la sentencia SQL de borrado
                    $consultaPre = $db->prepare("DELETE FROM NORMAS 
                                                        WHERE codigo = ?");   
                    // obtiene los parámetros de la variable predefinida $_POST
                    $consultaPre->bind_param('i', $ca);       
                    //ejecuta la consulta
                    $consultaPre->execute();

                    if($consultaPre->affected_rows==0) {
                        echo "<p>Búsqueda sin resultados. No se ha borrado nada</p>";
                    } else {
                        echo "<p>Registro eliminado.</p>";
                    }
                
                    $consultaPre->close();                   

                }

                public function generarInforme() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $consulta = $db->query("SELECT *
                                            FROM covid_dia 
                                            WHERE fecha = 
                                                        (SELECT MAX(fecha)
                                                        FROM covid_dia)");
                   
                    $informe = [];
                    $informe['casos_nuevos']=0;
                    $informe['pruebas']=0;
                    $informe['fallecidos']=0;
                    $informe['curados']=0;
                    $informe['hospital_planta']=0;
                    $informe['uci']=0;
                    $informe['fecha']=NULL;
                   
                    while ($fila = $consulta->fetch_assoc()) {
                        $informe['casos_nuevos'] += ((int) $fila['casos_nuevos']);
                        $informe['pruebas']+= ((int) $fila['pruebas']);
                        $informe['fallecidos']+= ((int) $fila['fallecidos']);
                        $informe['curados']+= ((int) $fila['curados']);
                        $informe['hospital_planta']+= ((int) $fila['hospital_planta']);
                        $informe['uci']+= ((int) $fila['uci']);
                        $informe['fecha'] = $fila['fecha'];
                    }

                    $informe['positividad'] = round(((double)$informe['casos_nuevos']*100/$informe['pruebas']),2).'%';
                    

                    $db->close();
                    
                    return $informe;
                    
                  
                }

                public function listarCCAA(){
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $sql = "SELECT codigo, nombre, num_hab FROM CCAA";
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table><tr><th>CODIGO</th><th>NOMBRE</th><th>NUM_HAB</th></tr>";
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<tr><td>".$row["codigo"]."</td><td>".$row["nombre"]."</td><td>".$row["num_hab"]."</td></tr>";
                        }
                        echo "</table>";
                      } else {
                        echo "0 results";
                      }
                      $db->close();

                }
                public function importarDatosCCAA() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'CCAA_importar.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE)
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
                    echo "!Importación exitosa!";
                       
                    
                    $db->close();
                   
                }
                public function exportarDatosCCAA() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM CCAA");

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    $fp = fopen('CCAA_exportada.csv', 'w');

                    foreach ($resultado as $line) {
                        fputcsv($fp, $line);
                    }

                    echo "!Exportación exitosa!";

                    fclose($fp);
                }
                public function importarDatosCovidDia() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'COVID_DIA_importar.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE)
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
                public function exportarDatosCovidDia() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM COVID_DIA");

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    $fp = fopen('COVID_DIA_exportada.csv', 'w');

                    foreach ($resultado as $line) {
                        fputcsv($fp, $line);
                    }

                    echo "!Exportación exitosa!";

                    fclose($fp);
                }
                public function importarDatosNormas() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    $filename = 'NORMAS_importar.csv';
                    $handle = fopen($filename, "r");
                     
                    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE)
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

                public function exportarDatosNormas() {
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    // prepara la consulta
                    $consultaPre = $db->prepare("SELECT * FROM NORMAS");

                    //ejecuta la consulta
                    $consultaPre->execute();

                    //Obtiene los resultados como un objeto de la clase mysqli_result
                    $resultado = $consultaPre->get_result();

                    $fp = fopen('NORMAS_exportada.csv', 'w');

                    foreach ($resultado as $line) {
                        fputcsv($fp, $line);
                    }

                    echo "!Exportación exitosa!";

                    fclose($fp);
                }

                public function modificarDatosCOVID($registro){
                    $db = $this->conectar();
                    
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    //prepara la sentencia de modificación
                    //UPDATE table SET column1 = value1, value2 = value2 WHERE column3 = value3
                    $consultaPre = $db->prepare("UPDATE COVID_DIA SET  casos_nuevos = ?,
                                                                    pruebas =? , fallecidos=?, curados=?, hospital_planta=?,
                                                                    uci=? where id = ?");
                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('iiiiiii', 
                        $registro['casos_nuevos'],
                        $registro['pruebas'],
                        $registro['fallecidos'],
                        $registro['curados'],
                        $registro['hospital_planta'],
                        $registro['uci'],
                        $registro['id'] );   

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if($consultaPre->affected_rows==0) {
                        echo "<p>Búsqueda sin resultados. No se ha modificado nada</p>";
                    } else {
                        echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";
                    }

                    $consultaPre->close();

                    
                    //cerrar la conexión
                    $db->close();
                }

                public function modificarDatosNormas($registro){
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    //prepara la sentencia de modificación
                    //UPDATE table SET column1 = value1, value2 = value2 WHERE column3 = value3
                    $consultaPre = $db->prepare("UPDATE NORMAS SET  bares = ?,
                                                                    toque_queda =? , distancia_interpersonal=?, grupos=? 
                                                WHERE id = ?");
                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('iisdi', 
                        $registro['bares'],
                        $registro['toque_queda'],
                        $registro['distancia_interpersonal'],
                        $registro['grupos']); 

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if($consultaPre->affected_rows==0) {
                        echo "<p>Búsqueda sin resultados. No se ha modificado nada</p>";
                    } else {
                        echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";
                    }
                    $consultaPre->close();

                    
                    //cerrar la conexión
                    $db->close();
                }

                public function modificarDatosCCAA($registro){
                    $db = $this->conectar();
                    $database = "covid";
                    
                    //selecciono la base de datos COVID para utilizarla
                    $db->select_db($database);

                    //prepara la sentencia de modificación
                    //UPDATE table SET column1 = value1, value2 = value2 WHERE column3 = value3
                    $consultaPre = $db->prepare("UPDATE CCAA SET  num_hab = ? WHERE id = ?");
                    //añade los parámetros de la variable Predefinida $_POST
                    $consultaPre->bind_param('ii', 
                        $registro['num_hab'],
                        $registro['id']
                    ); 

                    //ejecuta la sentencia
                    $consultaPre->execute();

                    if($consultaPre->affected_rows==0) {
                        echo "<p>Búsqueda sin resultados.</p>";
                    } else {
                        echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";
                    }

                    $consultaPre->close();

                    
                    //cerrar la conexión
                    $db->close();
                }

            

            }
?>