/*NombreNavegador.js*/
class NombreNavegador{
    constructor(){
        document.write("<h1>Nombre del navegador: ");
        document.write(infoNavegador.getNombre());
        document.write("</h1>");
    }
}
var nombreNavegador = new NombreNavegador();
