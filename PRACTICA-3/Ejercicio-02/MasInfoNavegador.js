/*MasInfoNavegador.js*/
class MasInfoNavegador{
    constructor(version, plataforma, vendedor, agente, javaActivo){
        document.write("<p>Versión: ");
        document.write(version);
        document.write("</p>");
        document.write("<p>Plataforma: ");
        document.write(plataforma);
        document.write("</p>");
        document.write("<p>Vendedor: ");
        document.write(vendedor);
        document.write("</p>");
        document.write("<p>Agente: ");
        document.write(agente);
        document.write("</p>");
        document.write("<p>Java activo: ");
        document.write(javaActivo);
        document.write("</p>");
    }
}
var masInfoNavegador = new MasInfoNavegador();
