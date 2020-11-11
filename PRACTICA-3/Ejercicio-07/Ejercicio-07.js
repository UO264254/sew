"use strict";

//Ocultar y mostrar los párrafos
$(document).ready(function(){
    $("#ocultarP").click(function(){
      $("p").hide();
    });
    $("#mostrarP").click(function(){
      $("p").show();
    });
  });

//Ocultar y mostrar la lista
$(document).ready(function(){
    $("#ocultarLista").click(function(){
      $("ul").hide();
    });
    $("#mostrarLista").click(function(){
      $("ul").show();
    });
  });

//Ocultar y mostrar la tabla
$(document).ready(function(){
    $("#ocultarTabla").click(function(){
      $("table").hide();
    });
    $("#mostrarTabla").click(function(){
      $("table").show();
    });
  });

//Modificar el texto de un párrafo. 
$(document).ready(function(){
    var original_text = $("#parrafo1").text();
    $("#modificarPMAY").click(function(){
        var texto = $("#parrafo1").text();
        console.log("texto ", texto);
        texto = texto.toUpperCase();
        console.log("Texto a fijar " + texto);
        $("#parrafo1").text(texto);
    });
    $("#mostrarPOrginial").click(function(){
        console.log("texto ", original_text);
        $("#parrafo1").text(original_text);
    });
});

//Modificar el color de fondo de todos los párrafos
$(document).ready(function(){
    $("#cambiarFondo").click(function(){
      $("p").css("background-color", "yellow");
      $('#cambiarFondo'). attr("disabled", true);
    });
    
});

//Añadir elementos
$(document).ready(function(){
    $("#botonAppend").click(function(){
        $("#titulo2").append(" de los Gremlins ");
        $('#botonAppend').attr("disabled", true);
    });

    $("#botonPrepend").click(function(){
        $("#parrafo1").prepend("Una película muy recomendada. ");
        $('#botonPrepend').attr("disabled", true);
    });

    $("#botonAfter").click(function(){
        $("#listaUltimo").after("<li> <a href=\"https://www.espinof.com/la-sexta/gremlins-perfecto-balance-comedia-terror-este-clasicazo-navideno-joe-dante\">Gremlins: un clasicazo</a> </li>");
        $('#botonAfter').attr("disabled", true);
        $('#botonAfterRemove').removeAttr("disabled");
    });

    $("#botonBefore").click(function(){
        $("#listaPrimero").before("<li> <a href=\"https://www.pinterest.es/rasiel4/gremlins/\">Imágenes Gremlins</a> </li>");
        $('#botonBefore').attr("disabled", true);
        $('#botonBeforeRemove').removeAttr("disabled");
    });

    $("#botonCrearElementos").click(function(){
        //$(this).attr('id',   this.id + '_' + new_id);
        var miTitulo2 = "<h2>Lista con enlaces de interés</h2>";
        var miParrafo = document.createElement("pre");
        miParrafo.innerHTML = "Son enlace muy importante para completar la información sobre Gremlins.";
        //miTitulo2.attr('id',   this.id + '_' + 'new_id');
        //$(this).attr('id',   this.miTitulo2 + '_' + 'new_id');
        $("#lista").before(miTitulo2);
        $("#lista").append(miParrafo);
        $('#botonCrearElementos').attr("disabled", true);
        $('#botonCrearElementosRemove').removeAttr("disabled");
    });

});

//Borrar elementos
    $(document).ready(function(){
        $("#botonAfterRemove").click(function(){
            $("#listaUltimo").next().remove();
            $('#botonAfter').removeAttr("disabled");
            $('#botonAfterRemove').attr("disabled", true);
        });

        $("#botonBeforeRemove").click(function(){
            $("#lista li").first().remove();
          
            $('#botonBefore').removeAttr("disabled");
            $('#botonBeforeRemove').attr("disabled", true);
        });

        $("#botonCrearElementosRemove").click(function(){
            $("#cambiarFondo").next().remove();
            $("pre").remove();
            $('#botonCrearElementosRemove').attr("disabled", true);
            $('#botonCrearElementos').removeAttr("disabled");
        });
    });

    $(document).ready(function(){
        $("#botonDOM").click(function(){
        $("*", document.body).each(function() {
                var etiquetaPadre = $(this).parent().get(0).tagName;
                var texto = document.createTextNode( 
                    "Elemento : " +
                    $(this).get(0).tagName +
                    " - Padre : " + etiquetaPadre); 
                var miParrafo = document.createElement("p");
                miParrafo.append(texto);
                $("#botonDOM").append(miParrafo);
            });
        });
    });