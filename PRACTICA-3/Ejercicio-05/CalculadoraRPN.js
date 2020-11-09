"use strict";
class CalculadoraBasica {
    constructor (){
       this.memVal = 0;
       
    }
   
    init() {
        this.pantalla = document.getElementById('pantalla');
        console.log("this.pantalla " , this.pantalla);
    }
    display(val) {
        this.mrcLast = 0;
        if(this.cleanBeforeDigit){
            this.pantalla.value='';
        }
        this.cleanBeforeDigit=0;
        this.pantalla.value += val;
    }
    digito(digito){
        if (String(this.pantalla.value)=='0') {
            this.pantalla.value='';
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
    
    borrar(){
        this.pantalla.value = 0;
        this.cleanBeforeDigit = 0;
    }
   
    
}
class CalculadoraCientifica extends CalculadoraBasica{

    constructor(){
        super();
        this.operando1=0
        
    }

    init(){
        super.init();
    }
    pi() {
        //this.cleanBeforeDigit=1;    //No se puede concatenar un dígito
        this.pantalla.value = Math.PI;
    }

    getNumberValue() {
        var x = 0;
        try {
           x=Number(this.pantalla.value);
        } catch (err) {
            x = 0;
        }
        return x;
    }
    
}

class PilaLIFO extends CalculadoraCientifica { 
    constructor (){
        super();
        this.pila = new Array();
        console.log(this.pantalla);
    }
    init() {
        super.init();
        this.displayPila = document.getElementById('displayPila');
    }
    push(valor){
        this.pila.push(valor);
    }
    pop(){
        return (this.pila.pop());
    }
    enter(){
        this.displayPila.value = this.pantalla.value + "\n" + this.displayPila.value;
        this.push(Number(this.pantalla.value));
        this.borrar();
    }

    mostrar(){
        var stringPila = "";
        for (var i in this.pila) stringPila = this.pila[i] + "\n" + stringPila;
        this.displayPila.value = stringPila;
    }

    sumar(){
        try{
            this.checkPilaStatus2Operandos();
            this.push(this.pop() + this.pop());
            this.mostrar();
        }catch(err) {
            alert(err);
        }
       
    }

    restar(){
        try{
            this.checkPilaStatus2Operandos();
            this.push(this.pop() - this.pop());
            this.mostrar();
        }catch(err) {
            alert(err);
        }
       
    }

    dividir(){
        try{
            this.checkPilaStatus2Operandos();
            this.push(this.pop() / this.pop());
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    multiplicar(){
        try{
            this.checkPilaStatus2Operandos();
            this.push(this.pop() * this.pop());
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    sin() {
        try{
            this.checkPilaStatusOperando();
            this.push(Math.sin(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    cos(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.cos(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    tan(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.tan(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
    }
    }

    cuadrado() {
        try{
            this.checkPilaStatusOperando();
            this.push(Math.pow(this.pop(), 2));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }
    pow() {
        try{
            this.checkPilaStatus2Operandos();
            this.push(Math.pow(this.pop(), this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    asin() {
        try{
            this.checkPilaStatusOperando();
            this.push(Math.asin(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    acos(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.acos(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    atan(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.atan(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    squareRoot(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.sqrt(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    exponencialTen(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.pow(10, this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    log(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.log(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    exp(){
        try{
            this.checkPilaStatusOperando();
            this.push(Math.exp(this.pop()));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }

    mod(){
        try{
            this.checkPilaStatus2Operandos();
            this.push(this.pop() % this.pop());
            this.mostrar();
        }catch(err) {
            alert(err);
        }
       
    }

    fact() {
        try{
            this.checkPilaStatusOperando();
            this.push(this.nFact(this.pop(), 1));
            this.mostrar();
        }catch(err) {
            alert(err);
        }
    }
    nFact(n, acc) {
        if (n == 0 || n == 1) return acc; 
        else return this.nFact(n-1, acc*n); 
    }

    backspace(){
        this.pop();
        this.mostrar();
    }catch(err) {
        alert(err);
    }
    
    checkPilaStatus2Operandos(){
        if(this.pila.length < 2){
            throw "El tamaño de la pila debe ser mayor o igual que 2"
        }
    }

    checkPilaStatusOperando(){
        if(this.pila.length < 1){
            throw "El tamaño de la pila debe ser igual que 1"
        }
    }
}

var calculadora = new PilaLIFO();