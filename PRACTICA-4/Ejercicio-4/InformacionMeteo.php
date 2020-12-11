class InformacionMeteo {

    public function __construct($ciudad){
        $this->apikey = "b1daf9771a43cb97e6f1456fd834a04c";
        $this->url = "https://api.openweathermap.org/data/2.5/weather?q=".$ciudad;
    }

    public function cargarDatos() {
       $url = $this->url."&mode=xml&units=metric&lang=es&APPID=".$this->apikey;
       $datos = file_get_contents($url);
       $xml = simplexml_load_string($datos);

       $this->ciudad = $xml->city[0]->attributes()['name'];
       $this->pais = $xml->city[0]->country;
       
       $this->amanece = $xml->city[0]->sun[0]->attributes()['rise'];
       $this->icono = "https://openweathermap.org/img/w/" . $xml->weather[0]->attributes()['icon'] . ".png";
       $this->descripcion = $xml->weather[0]->attributes()['value'];
       $this->temperatura = $xml->temperature[0]->attributes()['value'];
       $this->sensacion = $xml->feels_like[0]->attributes()['value'];
       $this->presion = $xml->pressure[0]->attributes()['value'];
       $this->humedad = $xml->humidity[0]->attributes()['value'];
       $this->nubosidad = $xml->clouds[0]->attributes()['value'];
       $this->visibilidad = $xml->visibility[0]->attributes()['value'];
       $this->direccionViento = $xml->wind[0]->direction[0]->attributes()['value'];
       $this->velocidadViento = $xml->wind[0]->speed[0]->attributes()['value'];
    }

    public function verNombreCiudad(){
        
        $datos = $this->ciudad.", ".$this->pais;

        return $datos;
    }

    public function verDatosMeteo(){
       
        $datos= "";
        $datos.="<pre>".$this->amanece."</pre>";
        $datos.="<p> <img alt = 'iconos' src='". $this->icono . "'>" . $this->descripcion."</p>";
        $datos.="<p>".$this->temperatura."ºC (sensación térmica: ".$this->sensacion."ºC)"."</p>";
        $datos.= "<table><tr><th id='presion'>Presión:</th><td headers='presion'>".
        $this->presion."mm</td><th id='humedad'>"."Humedad:</th><td headers='humedad'>".
        $this->humedad."%</td></tr>"."<tr><th id='nubosidad'>Nubosidad:</th><td headers='nubosidad'>".
        $this->nubosidad."%</td><th id='visibilidad'>Visibilidad:</th><td headers='visibilidad'>" . 
        $this->visibilidad ."m</td></tr>" . "<tr><th id='direccion'>Dirección del viento:</th><td headers='direccion'>" .
        $this->direccionViento . "º</td><th id='velocidad'>Velocidad del viento:</th><td headers='velocidad'>" . 
        $this->velocidadViento ."m/s</td></tr></table>";
       
        return $datos;
    }
}

$datosMeteo="";
$nombreCiudad="";
if (isset($_POST['ciudad'])) {
    $ciudad=$_POST['ciudad'];
    $ejercicio09 = new InformacionMeteo($ciudad);
    if (isset($_POST['ver'])) {
        $ejercicio09->cargarDatos();
    }
    $nombreCiudad = $ejercicio09->verNombreCiudad();
    $datosMeteo = $ejercicio09->verDatosMeteo();
}


// Interfaz con el usuario. 
echo "
    <form method='post' name='informacion'>
        <section>
            <h1>Información meteorológica</h1>
            
            <select id='ciudad' name = 'ciudad' title='ciudad' size='5'>
                <option value='aviles' >Avilés</option>
                <option value='gijon' >Gijón</option>
                <option value='mieres' >Mieres</option>
                <option value='cudillero' >Cudillero</option>
                <option value='lugones' >Lugones</option>
            </select>

            <input type='submit' title='ver' name = 'ver' value='Ver'/> 
            
        </section>
        <section id='tiempo'>
            <h2 id='nomCiudad'>$nombreCiudad</h2>
            <p id='datos'>$datosMeteo</p>
        </section>
    </form>
      
    ";
    