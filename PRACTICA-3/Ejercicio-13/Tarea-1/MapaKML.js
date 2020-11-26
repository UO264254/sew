class MapaKML{
    constructor(){
        if (window.File && window.FileReader && window.FileList && window.Blob) 
        {  
            //El navegador soporta el API File
            document.write("<p>Este navegador soporta el API File </p>");
        }
           else document.write("<p>¡¡¡ Este navegador NO soporta el API File y este programa puede no funcionar correctamente !!!</p>");
    }

    initMap(){  
        console.log("initMap");
        var centro = {lat: 43.3672702, lng: -5.8502461};
        this.mapaGeoposicionado = new google.maps.Map(document.getElementById('mapa'),{
            zoom: 10,
            center:centro,
            mapTypeId: google.maps.MapTypeId.TERRAIN
        });
    }
    
    leerKML(files){
        var errorArchivo = document.getElementById("errorLectura"),
            archivo = files[0],
            areaVisualizacion = document.getElementById("areaTexto");
           
            
        //Solamente admite archivos de tipo texto ???
        var tipoTexto = ".*\.kml$";
        if (archivo.name.match(tipoTexto)) 
        {
            var lector = new FileReader();
            var me = this;
            lector.onload = function (evento) {
                //hay que hacer algo
                me.extraerRutas(lector.result);
            }      
            lector.readAsText(archivo);
        } else {
            console.log(archivo);
            errorArchivo.innerText = "Error : ¡¡¡ Archivo no válido !!!";
            
          }
    }   
    extraerRutas(kml) {
        let parser = new DOMParser()
        let xmlDoc = parser.parseFromString(kml, "text/xml")
        let googlePolygons = []
        let googleMarkers = []

        if (xmlDoc.documentElement.nodeName == "kml") {

            for (const item of xmlDoc.getElementsByTagName('Placemark') ) {
                let placeMarkName = item.getElementsByTagName('name')[0].childNodes[0].nodeValue.trim()
                let lines = item.getElementsByTagName('LineString')
                let markers = item.getElementsByTagName('Point')

                /** MARKER PARSE **/    
                for (const marker of markers) {
                    var coords = marker.getElementsByTagName('coordinates')[0].childNodes[0].nodeValue.trim();
                    let coord = coords.split(",");
                    this.addMarca({ lat: +coord[1], lng: +coord[0] }, placeMarkName);
                }

                /** LINES PARSE **/        
                for (const line of lines) {
                    let coords = line.getElementsByTagName('coordinates')[0].childNodes[0].nodeValue.trim();
                    
                    let points = coords.split("\n");
                  
                    let linesPaths = [];
                    for (const point of points) {
                        let coord = point.split(","); 
                        linesPaths.push({ lat: +coord[1], lng: +coord[0] });
                    }
                    this.addLinea(linesPaths);
                    console.log(linesPaths);
                }

            }
        } else {
            throw "error while parsing"
        }

    return googleMarkers;
    }   
    addMarca(marca, title) {
        new google.maps.Marker({
                position: marca,
                map: this.mapaGeoposicionado,
                title: title
              });
    }
    addLinea(linesPaths) {
        const flightPath = new google.maps.Polyline({
            path: linesPaths,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
          });
          flightPath.setMap(this.mapaGeoposicionado);
    }

}
var mapaKML = new MapaKML();