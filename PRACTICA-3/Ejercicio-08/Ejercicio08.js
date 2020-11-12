"use strict";

class Ejercicio08 {
    constructor(){
        this.apikey = "b1daf9771a43cb97e6f1456fd834a04c";
        this.url = "http://api.openweathermap.org/data/2.5/weather?q=";
        
    }


    cargarDatos() {
       var ciudad = $("#ciudad option:selected:first").val();
       var url = this.url + ciudad  + "&units=metric&lang=es&APPID=" + this.apikey;
       var elEjercicio = this;
        $.ajax({
            dataType: "json",
            url: url,
            method: 'GET',
            success: function(data){
                console.log(data);
                elEjercicio.datos = data; 
                elEjercicio.mostrarTiempo();         
            },
            error:function(){
                document.write("<h2>¡problemas! No puedo obtener información de <a href='http://openweathermap.org'>OpenWeatherMap</a></h2>");    
            }
        });
    }

    mostrarTiempo(){
        
        
        $("#nomCiudad").text(this.datos.name +", " + this.datos.sys.country);
        
        var hora = new Date(this.datos.dt *1000).toLocaleTimeString();
        var fecha = new Date(this.datos.dt *1000).toLocaleDateString();
        var temperatura = this.datos.main.temp;
        var sensacion = this.datos.main.feels_like;
        var presion = this.datos.main.pressure;
        var humedad = this.datos.main.humidity;
        var descripcion = this.datos.weather[0].description;
        var visibilidad = this.datos.visibility;
        var nubosidad = this.datos.clouds.all;
        var direccionViento = this.datos.wind.deg;
        var velocidadViento = this.datos.wind.speed;
        

        var icono = "https://openweathermap.org/img/w/" + this.datos.weather[0].icon + ".png";

        var datos= "";
        datos += "<pre>" +  hora + ", " + fecha + "</pre>";
        
        datos += "<p>  <img src='" + icono + "' > "   + descripcion +"<p>";
        datos += "<p id='temp'>" + temperatura +"ºC (sensación térmica: " + sensacion +"ºC)<p>";
        datos += "<table><tr><th>Presión:</th><td>" +
            presion +"mm</td><th>" + "Humedad:</th><td>" + 
            humedad +"%</td></tr>" + "<tr><th>Nubosidad:</th><td>" + 
            nubosidad + "%</td><th>Visibilidad:</th><td>" + 
            visibilidad +"m</td></tr>" + "<tr><th>Dirección del viento:</th><td>" +
            direccionViento + "º</td><th>Velocidad del viento:</th><td>" + 
            velocidadViento +"m/s</td></tr></table>"        

        $("#datos").html(datos)
        $("#tiempo").show();
    }
}
var ejercicio08 = new Ejercicio08();

