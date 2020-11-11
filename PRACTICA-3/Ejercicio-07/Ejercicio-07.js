"use strict";

class Ejercicio07 {
    
    constructor () {
        var original_text;  
    }
    mostrarP(){
        $("p").show();
    }
    ocultarP(){
        $("p").hide();
    }

    mostrarLista(){
        $("ul").show();
    }

    ocultarLista(){
        $("ul").hide();
    }

    ocultarTabla(){
        $("table").hide();
    }
    mostrarTabla(){
        $("table").show();
    }

    modificarParrafoMay(){
        var texto = $("#parrafo1").text();
        this.original_text = texto;
        console.log("texto ", texto);
        texto = texto.toUpperCase();
        console.log("Texto a fijar " + texto);
        $("#parrafo1").text(texto);
    }
            
    mostrarParrafoOriginal(){
        $("#parrafo1").text(this.original_text);
    }
    
    cambiarFondo(){
        $("p").css("background-color", "yellow");
        $('#cambiarFondo'). attr("disabled", true);
    }

    añadirBotonAppend(){
        $("#titulo2").append(" de los Gremlins ");
        $('#botonAppend').attr("disabled", true);
        
    }

    añadirBotonPrepend(){
        $("#parrafo1").prepend("Una película muy recomendada. ");
        $('#botonPrepend').attr("disabled", true);
    }

    añadirBotonAfter(){
        $("#listaUltimo").after("<li> <a href=\"https://www.espinof.com/la-sexta/gremlins-perfecto-balance-comedia-terror-este-clasicazo-navideno-joe-dante\">Gremlins: un clasicazo</a> </li>");
        $('#botonAfter').attr("disabled", true);
        $('#botonAfterRemove').removeAttr("disabled");
    }

    añadirBotonBefore(){
        $("#listaPrimero").before("<li> <a href=\"https://www.pinterest.es/rasiel4/gremlins/\">Imágenes Gremlins</a> </li>");
        $('#botonBefore').attr("disabled", true);
        $('#botonBeforeRemove').removeAttr("disabled");
    }

    crearElementos(){
        var miTitulo2 = "<h2>Lista con enlaces de interés</h2>";
        var miParrafo = document.createElement("pre");
        miParrafo.innerHTML = "Son enlace muy importante para completar la información sobre Gremlins.";

        $("#lista").before(miTitulo2);
        $("#lista").append(miParrafo);
        $('#botonCrearElementos').attr("disabled", true);
        $('#botonCrearElementosRemove').removeAttr("disabled");
    }

    botonAfterRemove(){
        $("#listaUltimo").next().remove();
        $('#botonAfter').removeAttr("disabled");
        $('#botonAfterRemove').attr("disabled", true);
    }

    botonBeforeRemove(){
        $("#lista li").first().remove();
        $('#botonBefore').removeAttr("disabled");
        $('#botonBeforeRemove').attr("disabled", true);
    
    }

    botonCrearElementosRemove(){
        $("#cambiarFondo").next().remove();
        $("pre").remove();
        $('#botonCrearElementosRemove').attr("disabled", true);
        $('#botonCrearElementos').removeAttr("disabled");
    }

    visualizarArbolDOM(){
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
    }


    sumarFilasYColumnas(){
        var colCount = $("#recaudacion tr:last td").length;
        var totalTd =  $("#recaudacion tr td").length;
       
        var sum = 0;
        //Suma de filas
        $('#recaudacion tr td').each(function(index) { 
            console.log("index:" + index);
            if (index < totalTd - colCount) {   //no en la última fila
              
                if ((index+1) % colCount == 0) {
                    $(this).text(sum);
                    sum=0;
                } else {
                    sum += Number($(this).text());
                    console.log(" text=" + $(this).text() + " sum = " + sum);
                }
            }
         });
         //Suma de columnas
         var sumacols = [];
         for (var i = 0; i<colCount; i++) {
             sumacols[i]=0;
         }
         $('#recaudacion tr td').each(function(index) { 
            var ncol = index % colCount;
            if (index < totalTd - colCount) {   //no en la última fila
                sumacols[ncol] += Number($(this).text());
            } else { //ultima fila con los totales de columnas
                $(this).text(sumacols[ncol]);
            }
         });
    }
}
var ejercicio07 = new Ejercicio07();


