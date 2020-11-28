/*Parrafos.js*/
class Parrafos{
    constructor(){
        document.write("<p>Curso actual: ");
        document.write(asignatura.getCurso());
        document.write("</p>");
        document.write("<p>Estudiante: ");
        document.write(asignatura.getEstudiante());
        document.write("</p>");
        document.write("<p>e-mail: ");
        document.write(asignatura.getEmail());
        document.write("</p>");
    }

}
var parrafos = new Parrafos();
