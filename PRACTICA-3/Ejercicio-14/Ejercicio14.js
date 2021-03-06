
class Lienzo{
    constructor(){
    }
    init() {
        // Activar drag & drop
        this.canvas = document.getElementById('canvas');
        this.createImagen();
        
        this.canvas.addEventListener("dragover", function (evt) {
                evt.preventDefault();
        }, false);
        // Al hacer drop imagen 
        var me = this;
        this.canvas.addEventListener("drop", function (evt) {
            var files = evt.dataTransfer.files;
            if (files.length > 0) {
                var file = files[0];
                if (typeof FileReader !== "undefined" && file.type.indexOf("image") != -1) {
                    var reader = new FileReader();
                    reader.onload = function (evt) {
                        me.img.src = evt.target.result;
                        
                    };
                    reader.readAsDataURL(file);
                }
            }
            evt.preventDefault();
        }, false);

        //Comprobar si el navegador tiene indexeddb
		if (!('indexedDB' in window)) {
            alert('Este navegador no soporta IndexedDB');
            document.getElementById("guardar").style.visibility = "hidden";
        }
        //Abrir la base de datos
        var me = this;
        var request = window.indexedDB.open('dibusdb',2);
        request.onerror = function(event) {
        alert("No se ha podido abrir la BD");
        };
        request.onsuccess = function(event) {
        me.db = request.result;
        console.log("abierta con exito");
        };
        
        request.onupgradeneeded = function upgradeNeededFunction(e) {
            console.log("Actualizada");
            me.db = e.target.result;
            if (!me.db.objectStoreNames.contains('dibus')) {
            var objectStore = me.db.createObjectStore('dibus' , {autoIncrement: true});
            objectStore.createIndex('titulo', 'titulo', {unique: true});
            }
        };
        
        this.draw();
    }

    //Guardar el dibujo en la base de datos
    guardar() {
        var tx = this.db.transaction('dibus', 'readwrite');
        var store = tx.objectStore('dibus');
        var item = {
          titulo: document.getElementById("titulo").value,
          datos: this.canvas.toDataURL(),
          created: new Date().getTime()
        };
        store.add(item);
        tx.complete;
      console.log('Guardado en la bd!');
      
    }
    
    clearCanvas(context) {
       
        context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.hasText=false;
        
    }
    drawText(ctx) {
        this.hasText = true;

        
        ctx.fillStyle = 'rgb(200, 0, 0)';
        ctx.fillRect(220, 190, 10, 10);
        ctx.fillRect(220, 210, 10, 10);

        ctx.shadowOffsetX = 2;
        ctx.shadowOffsetY = 2;
        ctx.shadowBlur = 2;
        ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
        ctx.font = '20px Times New Roman';
        ctx.fillStyle = 'Black';



        ctx.fillText("Haz drop de una imagen", 240, 200);
        ctx.fillText("Haz click con el ratón y dibuja arrastrando", 240, 220);
    }
    grayscale(ctx) {
        const imageData = ctx.getImageData(0, 0, this.canvas.width, this.canvas.height);
        const data = imageData.data;
        for (var i = 0; i < data.length; i += 4) {
            var avg = (data[i] + data[i + 1] + data[i + 2]) / 3;
            data[i]     = avg; // red
            data[i + 1] = avg; // green
            data[i + 2] = avg; // blue
        }
        ctx.putImageData(imageData, 0, 0);
    }
    draw() {
        
        if (this.canvas.getContext) {
          var ctx = canvas.getContext('2d');
          var mouseDown = false;
            //Instrucciones
            this.drawText(ctx);
            var me = this;
            // Cargar imagen y dibujarla en el canvas   
            this.img.addEventListener("load", function () {
                if (me.hastText==true) {
                    me.clearCanvas(ctx);
                }
                var nfilas = 4;
                var ncols = 4;
                var w = me.canvas.width / nfilas;
                var h = me.canvas.height / ncols;
                for (var i = 0; i < nfilas; i++) {
                    for (var j = 0; j < ncols; j++) {
                        ctx.drawImage(me.img, j * w, i * h, w, h);
                        me.grayscale(ctx);
                    }
                }
               // ctx.drawImage(me.img, 0, 0);
            }, false);

            //Detectar botón pulsado ratón
            this.canvas.addEventListener("mousedown", function (evt) {
                if (me.hasText==true) {
                    me.clearCanvas(ctx);
                }
                mouseDown = true;
                ctx.beginPath();}, false);

            // Detectar botón levantado del ratón
            this.canvas.addEventListener("mouseup", function (evt) {
                mouseDown = false;
                var colors = ctx.getImageData(evt.layerX, evt.layerY, 1, 1).data;
            }, false);

            // Dibujar con el bottón pinchado
            this.canvas.addEventListener("mousemove", function (evt) {
                if (mouseDown) {
                    ctx.strokeStyle = me.getColor();                              
                    ctx.lineWidth = me.getWidth();
                    ctx.lineJoin = me.getLineJoin();
                    ctx.lineTo(evt.layerX+1, evt.layerY+1);
                    ctx.stroke();
                }
            }, false);
        }
        
    }

    pantallaCompleta() {
		
		if (!document.fullscreenElement) {
			document.documentElement.requestFullscreen();
		} else {
			if (document.exitFullscreen) {
				document.exitFullscreen(); 
			}
		}
	}

    getColor(){
        return document.getElementById("color").value;
    }

    getWidth(){
        return document.getElementById("grosor").value;
    }

    getLineJoin(){
        return document.getElementById("union").value;
    }

    clear(){
        var ctx = this.canvas.getContext('2d');
        this.clearCanvas(ctx);
    }

    createImagen(){
        this.img = document.createElement("img");
        this.img.setAttribute("id", "imagen");
        this.img.setAttribute("alt", "Imagen añadida");
        this.canvas.append(this.img);
    }
   
}
var lienzo = new Lienzo();