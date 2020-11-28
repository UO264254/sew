// Cabecera.js
class Cabecera{
    constructor(){
        var asignatura = new Object();
        asignatura.nombre = "Software y Estándares para la Web";
        asignatura.titulacion = "Grado en Ingeniería Informática del Software";
        asignatura.centro = "Escuela de Ingeniería Informática";
        asignatura.universidad = "Universidad de Oviedo";
        asignatura.curso = "2020-21";
        asignatura.estudiante = "Alejo Brandy García-Rovés";
        asignatura.email = "uo264254@uniovi.es";
        this.asignatura = asignatura;
    }
    
    getNombre(){
        return this.asignatura.nombre;
    }
    getTitulacion(){
        return this.asignatura.titulacion;
    }
    getCentro(){
        return this.asignatura.centro;
    }
    getUniversidad(){
        return this.asignatura.universidad;
    }
    getCurso(){
        return this.asignatura.curso;
    }
    getEstudiante(){
        return this.asignatura.estudiante;
    }
    getEmail(){
        return this.asignatura.email;
    }

}
var asignatura = new Cabecera();
