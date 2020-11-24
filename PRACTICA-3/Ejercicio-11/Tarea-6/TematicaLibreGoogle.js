

  class MapaDinamicoGoogle{
    constructor(){
      
    }
    getPosicion(posicion){
        this.longitud         = posicion.coords.longitude;
        console.log(this.longitud);
        this.latitud          = posicion.coords.latitude;
        console.log(this.latitud);   
        this.inicializarMapa(); 
    }
    verErrores(error){
        switch(error.code) {
        case error.PERMISSION_DENIED:
            this.mensaje = "El usuario no permite la peticiónn de geolocalización"
            break;
        case error.POSITION_UNAVAILABLE:
            this.mensaje = "Información de geolocalización no disponible"
            break;
        case error.TIMEOUT:
            this.mensaje = "La peticiÃ³n de geolocalización ha caducado"
            break;
        case error.UNKNOWN_ERROR:
            this.mensaje = "Se ha producido un error desconocido"
            break;
        }
    }
    initMap(){
        navigator.geolocation.getCurrentPosition(this.getPosicion.bind(this), this.verErrores.bind(this)); 
    }
    inicializarMapa() {
        this.places = [];
        var origen = {lat:this.latitud, lng: this.longitud};
        this.mapa = new google.maps.Map(document.getElementById('mapa'),{zoom: 15,center:origen});
        this.marcadorOrigen = new google.maps.Marker({position:origen,map:this.mapa});
        this.directionsRenderer = new google.maps.DirectionsRenderer();
        this.directionsService = new google.maps.DirectionsService();
        this.directionsRenderer.setMap(this.mapa);
       
        var me = this;
        document.getElementById("mode").addEventListener("change", () => {

            me.calculateAndDisplayRoute();
        });
    }  
    marcarLugares() {
      for(var i = 0; i< this.places.length; i++) {
        this.places[i].setMap(null);
      }
      this.places = [];
      if(document.getElementById("place").value == "1"){
        return;
      }
      var request = {
        location:  {
          lat:  this.latitud,
          lng: this.longitud
      },
        type: document.getElementById("place").value
      };

      console.log(request.type);
      
      var service = new google.maps.places.PlacesService(this.mapa);
      var me = this;
      service.textSearch(request, function (results, status) {
        console.log("results ", results);
       
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            var place = results[i].geometry.location;
            const image = {
              url:
                "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
              // This marker is 20 pixels wide by 32 pixels high.
              size: new google.maps.Size(20, 32),
              // The origin for this image is (0, 0).
              origin: new google.maps.Point(0, 0),
              // The anchor for this image is the base of the flagpole at (0, 32).
              anchor: new google.maps.Point(0, 32),
            };

            const marker = new google.maps.Marker({ position:place,
              map:me.mapa,
              title: results[i].name,
              animation: google.maps.Animation.DROP,
              icon: image});
            
            
            marker.addListener("click", () => {
              infowindow.open(marker.getMap(), marker);
            });

            me.places.push(marker);
    
            const contentString = 
            '<p>' + results[i].name + "</p>" +
            '<p>' + results[i].formatted_address + "</p>" +
            '<p> Rating: ' + results[i].rating + "</p>";

            const infowindow = new google.maps.InfoWindow({
              content: contentString,
            });

            
          }
          

        } else {
          console.error('NO SE HA ENCONTRADO :' , status);
        }
      });
    }
    
    ir (){
        this.marcadorOrigen.setMap(null);
        
        this.calculateAndDisplayRoute();
       
    }  
    calculateAndDisplayRoute() {
        const selectedMode = document.getElementById("mode").value;
        const destino =  document.getElementById("destino").value;
        if (destino==undefined) {
            window.alert('Debe especificar un destino');
            return;
        }
        this.directionsService.route({
            origin: {
                lat:  this.latitud,
                lng: this.longitud
            },
            destination: destino,
            travelMode: google.maps.TravelMode[selectedMode],
        },
        (response, status) => {
            if (status == "OK") {
                this.directionsRenderer.setDirections(response);
            } else {
                window.alert("Por favor, especifica más detalladamente el destino");
            }
        });
    }
}
var mapaDinamicoGoogle = new MapaDinamicoGoogle();
  