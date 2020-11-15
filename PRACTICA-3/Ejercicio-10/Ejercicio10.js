"use strict";

class Ejercicio10 {
    constructor(){
        $("#acciones").hide();
        this.maxwidth=200;
        this.maxheight=200;
    }

    cargarImagenes(){
        var me = this;
        var tag = $( "#menuImagen").val();
        $("#imagenes").empty();
        $("<h2>").appendTo( "#imagenes" );
        $("#imagenes h2").text("Carrusel de " + $( "#menuImagen option:selected" ).text());
        me.numImagenes = 5;
       
        var flickrAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?"; //cambiar api
        $.getJSON(flickrAPI, 
                {
                    tags: tag,
                    tagmode: "any",
                    format: "json"
                })
            .done(function(data) {
                    $.each(data.items, function(i,item ) {
                        $("<img>").attr( "src", item.media.m).attr("id", "img_" + i).appendTo( "#imagenes" );
                        if ( i == me.numImagenes - 1 ) {
                            return false;
                        }
                    });
                me.ajustar();
                $("#imagenes img").not(":first").hide();
                me.imagenActual = 0;
                $("#acciones").show();
        });
    }

    siguienteImagen(){    
        
        $("#img_" + this.imagenActual).slideUp();
        this.imagenActual++;
        if (this.imagenActual == this.numImagenes) {
            this.imagenActual=0;
        }
        
        $("#img_" + this.imagenActual).slideDown();
    }
    ajustar() {
        $("#imagenes img").each(function() {
            var width = $(this).width();
            var height = $(this).height();
            var ratio = 0;
            if (width > this.maxwidth) {
                ratio=this.maxwidth/width;
                $(this).css ("width", this.maxwidth);
                $(this).css ("height", height * ratio);
                height=height * ratio;
            }
            width=$(this).width ();
            height = $(this).height()
            if (height>this.maxheight) {
                ratio=this.maxheight/height;
                $(this).css ("height", this.maxheight);
                $(this).css ("width", width * ratio);
                width=width * ratio;
            }
        });
    }
    
}
function init(){
    ejercicio10 = new Ejercicio10();
}
var ejercicio10;