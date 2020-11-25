class Ejercicio12{
    constructor(){
        if (window.File && window.FileReader && window.FileList && window.Blob) 
        {  
            //El navegador soporta el API File
            document.write("<p>Este navegador soporta el API File </p>");
        }
           else document.write("<p>¡¡¡ Este navegador NO soporta el API File y este programa puede no funcionar correctamente !!!</p>");
    }
    
    leerArchivoTexto(){
               
        var files = document.getElementById("archivoTexto").files,
            nArchivos = files.length,
            archivo,
            informacion = document.getElementById("informacion"),
            errorArchivo = document.getElementById("errorLectura"),
            nBytes = 0;
            
            for (var i = 0; i < nArchivos; i++) {
            archivo = files[i];
            nBytes += files[i].size;
            
            var elemento = document.createElement("ul");
            elemento.innerHTML = "<li> Nombre del archivo: " + archivo.name + "</li> ";
            elemento.innerHTML += "<li> Tamaño del archivo: " + archivo.size + " bytes" + "</li> ";
            elemento.innerHTML += "<li> Tipo del archivo: " + archivo.type + "</li> ";
            elemento.innerHTML += "<li> Fecha de la última modificación: " + archivo.lastModifiedDate + "</li> ";
            elemento.innerHTML += "<li> Contenido del archivo de texto: </li> ";
            elemento.innerHTML += "<pre class='contenidoFichero'></pre>";
            informacion.append(elemento);
            
            //Solamente admite archivos de tipo texto o application
            var tipoTexto = /text.*/;
            var tipoApplication = /application.*/;
            if (archivo.type.match(tipoTexto) || archivo.type.match(tipoApplication)) 
                {
                var lector = new FileReader();
                lector.onload = function (evento) {
                    var eFicheros = document.getElementsByClassName("contenidoFichero");
                    console.log(eFicheros);
                    for (var j=0; j<eFicheros.length; j++) {
                        if (eFicheros[j].innerText=="") {
                            eFicheros[j].innerText = evento.currentTarget.result;
                            break;
                        }
                    }
                    
                }      
                lector.readAsText(archivo);
                }
            else {
                errorArchivo.innerText = "Error : ¡¡¡ Archivo no válido !!!";
                }
        }
        document.getElementById("tamaño").innerHTML = "Tamaño de todos los archivos " + nBytes + " bytes";
        


    }

}
var ejercicio12 = new Ejercicio12();