/*MasInfoNavegador.js*/
class MasInfoNavegador{
    constructor(){
        document.write("<p>Versión: ");
        document.write(infoNavegador.getVersion());
        document.write("</p>");
        document.write("<p>Plataforma: ");
        document.write(infoNavegador.getPlataforma());
        document.write("</p>");
        document.write("<p>Vendedor: ");
        document.write(infoNavegador.getVendedor());
        document.write("</p>");
        document.write("<p>Agente: ");
        document.write(infoNavegador.getAgente());
        document.write("</p>");
        document.write("<p>Java activo: ");
        document.write(infoNavegador.getJavaActivo());
        document.write("</p>");
    }
}
var masInfoNavegador = new MasInfoNavegador();
