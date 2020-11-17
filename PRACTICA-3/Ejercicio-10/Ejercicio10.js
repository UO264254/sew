"use strict";

class Ejercicio10 {
    constructor(){
        $("#acciones").hide();
        this.maxwidth=200;
        this.maxheight=200;
        this.numImagenes = 5;
        this.photo_ids = [];
        this.secrets = [];
    }
    cargarImagenes() {
        var tag = $( "#menuImagen").val();
        switch (tag) {
            case 'recientes':
                this.cargarRecientes();
                break;
            case 'interesantes' :
                this.cargarInteresantes();
                break;
            default:
                this.cargarTema(tag);
                break;
        }
        $("#imagenes").empty();
        $("<h2>").appendTo( "#imagenes" );
        $("#imagenes h2").text("Carrusel de " + $( "#menuImagen option:selected" ).text());
    }
    cargarRecientes() {
        var me = this;
        this.photo_ids=[];
        var flickrAPI =  "https://www.flickr.com/services/rest/?jsoncallback=?";
        $.getJSON(flickrAPI, 
                {
                    method: "flickr.photos.getRecent",
                    api_key: "5a7658d7ab10dea35508741cfc4ef535",
                    format:"json"
                })
            .done(function(data) {
                    $.each(data.photos.photo, function(i,item ) {
                        var srcImg = "https://live.staticflickr.com/"+item.server+"/"+item.id+"_" + item.secret + ".jpg";
                        $("<img>").attr( "src", srcImg).attr("id", "img_" + i).appendTo( "#imagenes" );
                        me.photo_ids.push(item.id);
                        me.secrets.push(item.secret);
                        if ( i == me.numImagenes - 1 ) {
                            return;
                        }
                        me.ajustar();
                        $("#imagenes img").not(":first").hide();
                        me.imagenActual = 0;
                        $("#acciones").show();
                        me.mostrarSizesImagen(me.photo_ids[0]);
                    });
            
        });

    }

    cargarInteresantes() {
        var me = this;
        this.photo_ids=[];
        var flickrAPI =  "https://www.flickr.com/services/rest/?jsoncallback=?";
        $.getJSON(flickrAPI, 
                {
                    method: "flickr.interestingness.getList",
                    api_key: "5a7658d7ab10dea35508741cfc4ef535",
                    format:"json"
                })
            .done(function(data) {
                    $.each(data.photos.photo, function(i,item ) {
                        var srcImg = "https://live.staticflickr.com/"+item.server+"/"+item.id+"_" + item.secret + ".jpg";
                        $("<img>").attr( "src", srcImg).attr("id", "img_" + i).appendTo( "#imagenes" );
                        me.photo_ids.push(item.id);
                        me.secrets.push(item.secret);
                        if ( i == me.numImagenes - 1 ) {
                            return;
                        }
                        me.ajustar();
                        $("#imagenes img").not(":first").hide();
                        me.imagenActual = 0;
                        $("#acciones").show();
                        me.mostrarSizesImagen(me.photo_ids[0]);
                    });
            
        });
    }
    cargarTema(tag){
        var me = this;
      
        var photo_ids=[];
        var flickrAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
        $.getJSON(flickrAPI, 
                {
                    tags: tag,
                    tagmode: "any",
                    format: "json"
                })
            .done(function(data) {
                    $.each(data.items, function(i,item ) {
                        var link = item.link.split('/');
                        
                        me.photo_ids.push(link[link.length-2]);
                        
                        $("<img>").attr( "src", item.media.m).attr("id", "img_" + i).appendTo( "#imagenes" );
                        if ( i == me.numImagenes - 1 ) {
                            return false;
                        }
                    });
                me.ajustar();
                $("#imagenes img").not(":first").hide();
                me.imagenActual = 0;
                $("#acciones").show();
                me.mostrarSizesImagen(me.photo_ids[0]);
        });

        
    }
    /*mostrarSizesImagen(idImagen) {
        var url = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
       
        $.getJSON(url, 
                {
                    method: "flickr.photos.getSizes",
                    photo_id: idImagen,
                    api_key: "5a7658d7ab10dea35508741cfc4ef535",
                    format:"json"

                })
            .done(function(data) {
                for(var i = 0; i < data.length; i++){
                    data.
                }
            });
    }*/
    mostrarSizesImagen(idImagen) {
        var url = "https://www.flickr.com/services/rest/?jsoncallback=?";
       
        $.getJSON(url, 
                {
                    method: "flickr.photos.getSizes",
                    api_key: "5a7658d7ab10dea35508741cfc4ef535",
                    photo_id: idImagen,
                    format:"json"

                })
            .done(function(data) {
                var sizes = data.sizes.size;
                console.log(sizes);
                var datos= "<ul>";
                for(var i = 0; i < sizes.length; i++){      
                    console.log(sizes[i].source)  
                    datos += "<li><a href='"+ sizes[i].source + "' >" + sizes[i].label + "</a></li>";
                }
                datos+= "</ul>";
                $("#datos").html(datos);
            });

    }
    siguienteImagen(){    
        
        $("#img_" + this.imagenActual).slideUp();
        this.imagenActual++;
        if (this.imagenActual == this.numImagenes) {
            this.imagenActual=0;
        }
        
        $("#img_" + this.imagenActual).slideDown();
        this.mostrarSizesImagen(this.photo_ids[this.imagenActual]);
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