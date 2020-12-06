"use strict";

class Ejercicio09 {
    constructor(){
        this.apikey = "b1daf9771a43cb97e6f1456fd834a04c";
        this.url = "https://api.openweathermap.org/data/2.5/weather?q=";
        
    }


    cargarDatos() {
       var ciudad = $("#ciudad option:selected:first").val();
       var url = this.url + ciudad  + "&mode=xml&units=metric&lang=es&APPID=" + this.apikey;
       var elEjercicio = this;
        $.ajax({
            dataType: "xml",
            url: url,
            method: 'GET',
            success: function(data){
                elEjercicio.mostrarTiempo(data);         
            },
            error:function(){
                document.write("<h2>¡problemas! No puedo obtener información de <a href='https://openweathermap.org'>OpenWeatherMap</a></h2>");    
            }
        });
    }

    mostrarTiempo(data){
        
        var ciudad = $('city',data).attr("name");
        var pais = $('country',data).text();
        $("#nomCiudad").text(ciudad +", " + pais);

        var horaMedida = $('lastupdate',data).attr("value");
        var icono = "https://openweathermap.org/img/w/" + $('weather',data).attr("icon") + ".png";
        var descripcion= $('weather',data).attr("value");
        var temperatura = $('temperature',data).attr("value");
        var sensacion = $('feels_like',data).attr("value");
        var presion = $('pressure',data).attr("value");
        var humedad = $('humidity',data).attr("value");
        var nubosidad = $('clouds',data).attr("value");
        var visibilidad = $('visibility',data).attr("value");
        var velocidadViento = $('speed',data).attr("value");
        var direccionViento = $('direction',data).attr("value");

        var datos= "";
        datos += "<pre>" +  horaMedida + "</pre>";
        datos += "<p>  <img src='" + icono + "' > "   + descripcion +"<p>";
        datos += "<p id='temp'>" + temperatura +"ºC (sensación térmica: " + sensacion +"ºC)<p>";
        datos += "<table><tr><th>Presión:</th><td>" +
        presion +"mm</td><th>" + "Humedad:</th><td>" + 
        humedad +"%</td></tr>" + "<tr><th>Nubosidad:</th><td>" + 
        nubosidad + "%</td><th>Visibilidad:</th><td>" + 
        visibilidad +"m</td></tr>" + "<tr><th>Dirección del viento:</th><td>" +
        direccionViento + "º</td><th>Velocidad del viento:</th><td>" + 
        velocidadViento +"m/s</td></tr></table>";


        $("#datos").html(datos)
        $("#tiempo").show();
    }
}
var ejercicio09 = new Ejercicio09();

