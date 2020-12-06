class Calculadora {
    protected $memVal=0;
    protected $mrcLast=0;
    protected $igualPressed = 0;
    protected $pantalla="";
    
    public function __construct($val, $mem){
		error_log("consturctor con memoria ".$mem);
        $this->pantalla=$val;
		$this->memVal = $mem;
        if (isset($_SESSION['igualPressed'])) {
            $this->igualPressed=$_SESSION['igualPressed'];
            error_log("*** igualPressed guardado en sesion ".$this->igualPressed);
        }
        if (isset($_SESSION['mrcLast'])) {
            $this->mrcLast=$_SESSION['mrcLast'];
            error_log("*** mrcLast guardado en sesion ".$this->mrcLast);
        }
    }
    public function display( $val ) {  
        $this->mrcLast = 0;
        if($this->igualPressed==1){ //Antes de pintar el dígito limpia la pantalla
            $this->pantalla='';
        }
        $this->igualPressed = 0;
        $this->pantalla .= $val;
    }

    public function digitos($digito){
        if ($this->pantalla=='0') {
            $this->pantalla='';
        }
        $this->display($digito);
    }
    public function operador($op)  {
        if ($this->pantalla=="" || $this->igualPressed==1) {
            $this->borrar();
            return;
        }
        $this->display($op);
    }
    public function mrc(){
		error_log("***mrc en memoria ".$this->memVal);
        $this->igualPressed = 0;
        $this->igual();   //Se calcula la operación de la pantalla
        //si es la última tecla pulsada
        //1. limpiamos la memoria
        if($this->mrcLast){
            $this->memVal = 0;
        } else{
            // si no fijamos el valor de la memoria en la pantalla
            $this->borrar();
            $this->pantalla=$this->memVal;
        }        
        $this->mrcLast = 1; //Se marca como última tecla pulsada
    }

    public function mMenos(){
        $this->igualPressed = 0;
        $this->igual();
		try {
			$this->memVal = ((double) $this->memVal) - ((double) $this->pantalla);
		} catch (Exception $e) {
			$this->memVal = 0;
		}
		error_log("*** mMenos deja en memoria ".$this->memVal);
    }

    public function mMas(){
        $this->igualPressed = 0;
        $this->igual();
		try {
			$this->memVal = ((double) $this->memVal) + ((double) $this->pantalla);
		} catch (Exception $e) {
			$this->memVal = 0;
		}
		error_log("*** mMas deja en memoria ".$this->memVal);
    }

    public function borrar(){
        $this->pantalla = "";
        $this->igualPressed = 0;
    }

    public function igual(){
		if(strlen($this->pantalla)){
			error_log("*** eval(".$this->pantalla.")");
			try {
				$this->pantalla = eval("return ".$this->pantalla.";");
			} catch (Exception $e) {
				$this->pantalla = "Error ".$e->getMessage();
                return;
			}
		}
        $this->igualPressed = 1;
        error_log("*** acabando con ".$this->pantalla);
    }

    public function ver() {
        return  $this->pantalla;
    }

	public function memoria() {
        return  $this->memVal;
    }

	public function verMrcLast() {
		return $this->mrcLast;
    }
    
	public function verIgualPressed() {
		return $this->igualPressed;
	}
    
}
$memoria=0;
if (isset($_POST['memoria'])) {
	$memoria=$_POST['memoria'];
}
$resultado="";
if (isset($_POST['pantalla'])) {
    $resultado=$_POST['pantalla'];
}
$calculadora = new Calculadora($resultado, $memoria);


if (isset($_POST['mrc'])) {
    $calculadora->mrc();
} else if (isset($_POST['mMenos'])){
	$calculadora->mMenos();
} else if (isset($_POST['mMas'])) {
	$calculadora->mMas();
} else if (isset($_POST['digito'])) {
    $calculadora->digitos($_POST['digito']);
} else if (isset($_POST['operador'])) {
    $calculadora->operador($_POST['operador']);
} else if (isset($_POST['igual'])) {
	$calculadora->igual();
} else if (isset($_POST['borrar'])) {
	$calculadora->borrar();
}
$resultado=$calculadora->ver();
$memoria=$calculadora->memoria();
$_SESSION['mrcLast']=$calculadora->verMrcLast();
$_SESSION['igualPressed']=$calculadora->verIgualPressed();

// Interfaz con el usuario. 
echo "
        <!-- Tabla donde se muestra la calculadora-->
      <form method='post' name='calculadora'>
      
        <table> 
            <tr> 
                <th colspan='4'><p>Resultado:</p>
                <input type='text' name='pantalla' title='resultado' value='$resultado' readonly/></th> 
            </tr>
            <tr>
                <td><input type='submit' class='memoria' name='mrc' value='mrc'/> </td>
                <td><input type='submit' class='memoria' name='mMenos' value='m-'/> </td>
                <td><input type='submit' class='memoria' name='mMas' value='m+'/> </td>
                <td><input type='submit' class='operador' name='operador' value='/'/> </td> 
            </tr>
            <tr>
                <td><input type='submit' class='digito' name='digito' value='7' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='8' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='9' /> </td>
                <td><input type='submit' class='operador' name='operador' value='*' /> </td> 
            </tr>
            <tr> 
                <td><input type='submit' class='digito' name='digito' value='4' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='5' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='6' /> </td> 
                <td><input type='submit' class='operador' name='operador' value='-'/> </td> 
            </tr> 
                <tr> 
                <td><input type='submit' class='digito' value='1' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='2' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='3' name='digito'/> </td>
                <td><input type='submit' class='operador' value='+' name='operador'/> </td> 
                </tr> 
                <tr>
                <td><input type='submit' class='digito' value='0' name='digito'/> </td>
                <td><input type='submit' class='digito' value='.' name='operador'/> </td> 
                <td><input type='submit' class='digito' value='c' name='borrar'/> </td> 
                <td><input type='submit' class='igual' value='=' name='igual'/> </td> 
                
            </tr> 
        </table>
        <input type='text' name='memoria' title='memoria' value='$memoria' hidden/>
      </form>
      
    ";
    