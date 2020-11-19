class MapaDinamicoGoogle{
    constructor(){  
    }
    initMap(){
        var aviles = {lat: 43.5547300, lng: -5.9248300};
        var mapaAviles = new google.maps.Map(document.getElementById('mapa'),{zoom: 8,center:aviles});
        var marcador = new google.maps.Marker({position:aviles,map:mapaAviles});
    }
}
var mapaDinamicoGoogle = new MapaDinamicoGoogle();