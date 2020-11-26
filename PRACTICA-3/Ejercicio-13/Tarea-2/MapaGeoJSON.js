class MapaGeoJSON{
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
    
    leerGeoJSON(files){
        var errorArchivo = document.getElementById("errorLectura"),
            archivo = files[0],
            areaVisualizacion = document.getElementById("areaTexto");
           
            
        //Solamente admite archivos de tipo texto MapaGeoJSON
        var tipoTexto = ".*\.GeoJSON$";
        if (archivo.name.match(tipoTexto)) 
        {
            var lector = new FileReader();
            var me = this;
            lector.onload = function (evento) {
                var contenidoGeoJSON = JSON.parse(lector.result);
                me.mapaGeoposicionado.data.addGeoJson(contenidoGeoJSON);
            }      
            lector.readAsText(archivo);
        } else {
            console.log(archivo);
            errorArchivo.innerText = "Error : ¡¡¡ Archivo no válido !!!";
            
          }
    } 

}
var mapaGeoJSON = new MapaGeoJSON();