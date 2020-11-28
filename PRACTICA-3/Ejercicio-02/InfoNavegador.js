/*InfoNavegador.js*/
class InfoNavegador{
    constructor(){
        var infoNavegador = new Object();
        infoNavegador.nombre = navigator.appName;
        infoNavegador.idioma = navigator.language;
        infoNavegador.version = navigator.appVersion;
        infoNavegador.plataforma = navigator.platform;
        infoNavegador.vendedor = navigator.vendor;
        infoNavegador.agente = navigator.userAgent;
        infoNavegador.javaActivo = navigator.javaEnabled();
        this.infoNavegador = infoNavegador;
    }
    init(){
        new NombreNavegador(this.getNombre());
        new IdiomaNavegador(this.getIdioma());
        new MasInfoNavegador(this.getVersion(), this.getPlataforma(), this.getAgente(), this.getJavaActivo());
    }

    getNombre(){
        return this.infoNavegador.nombre;
    }

    getIdioma(){
        return this.infoNavegador.idioma;
    }

    getVersion(){
        return this.infoNavegador.version;
    }

    getPlataforma(){
        return this.infoNavegador.plataforma;
    }

    getVendedor(){
        return this.infoNavegador.vendedor;
    }

    getAgente(){
        return this.infoNavegador.agente;
    }

    getJavaActivo(){
        return this.infoNavegador.javaActivo;
    }
}

var infoNavegador = new InfoNavegador();

