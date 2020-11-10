"use strict";
class CalculadoraUnits {
    constructor (){
        this.medidas = { 
            "longitud" : ["metro" , "kilómetro" , "milla", "yarda", "pies"],
            "superficie": ["metro cuadrado", "kilómetro cuadrado", "hectárea", "acre"],
            "volumen": ["metro cúbico", "US pinta", "US galón", "litro", "galón imperial"],
            "peso": ["kilogramo", "gramo", "tonelada", "libra", "onza"],
            "potencia": ["W", "MW", "kW", "hW", "daW"],
            "energia": ["J", "MJ", "kJ", "mJ", "µJ"]
        }
        this.factorDeBaseA = {
            "longitud" : [1 , 0.001 , 0.0006213689, 1.0936132983, 3.280839895],
            "superficie": [1, 0.000001, 0.0001, 0.0002471054],
            "volumen": [1, 2113.3774149, 264.17217686, 1000 , 219.9692483],
            "peso": [1, 1000, 0.001, 2.2046244202, 35.273990723],
            "potencia": [1,0.000001, 0.001, 0.01, 0.1],
            "energia" : [1, 1000000, 1000, 0.001, 0.000001]
        }
        this.factorABase = {
            "longitud" : [1 , 1000 , 1609.35, 0.9144, 0.3048],
            "superficie": [1, 1000000, 10000 , 4046.8564224],
            "volumen": [1, 0.0004731763, 0.00378541, 0.001,  0.00454609],
            "peso": [1, 0.001, 1000, 0.453592, 0.0283495],
            "potencia" : [1, 1000000, 1000, 100, 10],
            "energia" : [1, 0.000001, 0.001, 1000, 1000000]
        }
        this.selectDe = document.getElementById("from");
        this.selectA = document.getElementById("to");
        this.tipoMedida = document.getElementById("tipoMedida");
        
        this.valorEnMedidaBase=1;
        document.getElementById("pantalla").value=1;
        this.tipoMedida.value = "longitud";
        this.onSelectMedida();
        
    }
    onSelectMedida() {
        var x = this.tipoMedida.value;
        this.cargarListas(x);
        this.selectDe.value=this.medidas[this.tipoMedida.value][0];
        this.convertir();
      }
    removeAllOptions() {
        if (this.selectA.options) {
            while (this.selectA.options.length > 0) {
                this.selectA.remove(0);
                this.selectDe.remove(0);
            }
        }
    }
    convertir() {
        var medida = this.tipoMedida.value;
        var valor = document.getElementById("pantalla").value;
        var de = this.selectDe.value
        var iDe = this.medidas[medida].indexOf(de);
        this.valorEnMedidaBase = Number(valor) * Number(this.factorABase[medida][iDe]);
        
        var resultado = 0;
        var literal;
        for (var i=0; i<this.selectA.options.length; i++) {
            resultado = (this.valorEnMedidaBase * this.factorDeBaseA[medida][i]).toFixed(6);
            literal = this.medidas[medida][i];
            if (!literal.endsWith('s')) {
                literal += 's';
            }
            this.selectA.options[i].text =  resultado + " " +  literal ;

           
        }
    }
    cargarListas(medida) {
       //borrar todas las options y crear las nuevas
       this.removeAllOptions();
       
       var lista = this.medidas[medida];

       for (var i = 0; i < lista.length; i++) {
            var newOption = this.crearOption(lista[i]);
            this.selectDe.appendChild(newOption);
            newOption = this.crearOption(lista[i]);
            this.selectA.appendChild(newOption);
        }
        
    }
    crearOption(value) {
        // crear option
        var newOption = document.createElement('option');
        var optionText = document.createTextNode(value);
        newOption.appendChild(optionText);
        newOption.value = value;
        
        return newOption;
    }
}
function init() {
    calculadora = new CalculadoraUnits();
    
}
var calculadora;