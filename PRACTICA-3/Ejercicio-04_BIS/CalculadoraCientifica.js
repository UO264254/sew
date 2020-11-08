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
        if(this.cleanBeforeDigit){
            this.getPantalla().value='';
        }
        this.cleanBeforeDigit=0;
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
        this.cleanBeforeDigit = 0;
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
        this.cleanBeforeDigit = 0;
        this.igual();
        try{
            this.memVal = Number(this.memVal) - Number(this.getPantalla().value);
        }catch(err) {
            this.memVal=0;
        }
    }
    mMas(){
        this.cleanBeforeDigit = 0;
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
        this.cleanBeforeDigit = 0;
    }
   
    
}
class CalculadoraCientifica extends CalculadoraBasica{

    constructor(){
        super();
        this.operando1=0
    }
    pi() {
        this.cleanBeforeDigit=1;    //No se puede concatenar un dígito
        this.getPantalla().value = Math.PI;
    }
    ce(){
        console.log("ce()");
    }
    flecha() {
        console.log("flecha()");
    }
    cuadrado() {
        this.igual();
        
        this.getPantalla().value = Math.pow(this.getPantalla().value, 2);
    }
    leftParentesis() {
        this.display('(');
    }
    rightParentesis() {
        this.display(')');
    }
    getNumberValue() {
        var x = 0;
        try {
           x=Number(this.getPantalla().value);
        } catch (err) {
            x = 0;
        }
        return x;
    }
    store() {
        this.igual();
        this.operando1=this.getNumberValue();
    }
    pow() {
        
        this.store();
        this.pendingOperation=this.powFunc;
    }
    powFunc() {
        this.getPantalla().value = Math.pow(this.operando1, this.getNumberValue());
        this.pendingOperation=null;
    }
    sin() {
        this.igual();
        this.getPantalla().value = Math.sin(this.getNumberValue());
    }
    cos() {
        this.igual();
        this.getPantalla().value = Math.cos(this.getNumberValue());
    }
    tan() {
        this.igual();
        this.getPantalla().value = Math.tan(this.getNumberValue());
    }
    squareRoot() {
        this.igual();
        this.getPantalla().value = Math.sqrt(this.getNumberValue());
    }
    fact() {
        this.igual();
        this.getPantalla().value = this.nFact(this.getNumberValue(), 1);
    }
    nFact(n, acc) {
        if (n == 0 || n == 1) return acc; 
        else return this.nFact(n-1, acc*n); 
    }
    mod() {
        this.display('%');
    }
    igual(){
        if (this.pendingOperation) {
            this.pendingOperation();
        } else {
            var str = this.getPantalla().value;
            
            try{
                if(str!=undefined){
                    this.getPantalla().value = eval(str);
                } else {
                    this.getPantalla().value = 0;
                }
                this.cleanBeforeDigit = 1;
            }
            catch(err) {
                this.getPantalla().value = "Error = " + err;
            }
        }
    }
}
var calculadora = new CalculadoraCientifica();