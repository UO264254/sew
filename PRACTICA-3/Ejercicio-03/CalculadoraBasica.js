"use strict";
class CalculadoraBasica {
    constructor (){
       this.memVal = 0;
    }
    getPantalla() {
        return document.getElementById('pantalla');
    }
    display(val) {
        this.mrcLast = 0;
        if(this.igualPressed){
            this.getPantalla().value='';
        }
        this.igualPressed=0;
        this.getPantalla().value += val;
    }
    digitos(digito){
        if (String(this.getPantalla().value)=='0') {
            this.getPantalla().value='';
        }
        this.display(digito);
    }
    punto(){
        this.display('.');
    } 
    sumar(){
        this.display('+');
    }
    restar(){
        this.display('-');
    }
    multiplicar(){
        this.display('*');
    }
    dividir(){
        this.display('/');
    }
    mrc(){
        this.igualPressed = 0;
        this.igual();   //Se calcula la operación de la pantalla
        //si es la última tecla pulsada
        //1. limpiamos la memoria
        if(this.mrcLast){
            this.memVal = 0;
        } else{
            // si no fijamos el valor de la memoria en la pantalla
            this.borrar();
            this.getPantalla().value=this.memVal;
        }        
        this.mrcLast = 1; //Se marca como última tecla pulsada
    }
    mMenos(){
        this.igualPressed = 0;
        this.igual();
        try{
            this.memVal = Number(this.memVal) - Number(this.getPantalla().value);
        }catch(err) {
            this.memVal=0;
        }
    }
    mMas(){
        this.igualPressed = 0;
        this.igual();
        try{
            this.memVal = Number(this.memVal) + Number(this.getPantalla().value);
        }
        catch(err) {
            this.memVal=0;
        }
        
    }
    borrar(){
        this.getPantalla().value = 0;
        this.igualPressed = 0;
    }
    igual(){
        var str = this.getPantalla().value;
        
        try{
            if(str!=undefined){
                this.getPantalla().value = eval(str);
            }
            this.igualPressed = 1;
        }
        catch(err) {
            this.getPantalla().value = "Error = " + err;
        }
    }
    
}
var calculadora = new CalculadoraBasica();