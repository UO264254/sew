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


class CalculadoraCientifica extends Calculadora{
    // constructor
    public function __construct($val, $mem){
        parent::__construct($val, $mem);
    }

    public function pi() {
        $this->pantalla = M_PI;
        
    }
    public function backspace(){
        $this->pantalla = substr($this->pantalla, 0, strlen($this->pantalla) - 1);
    }
    public function cuadrado() {
        $this->igual();
        
        $this->pantalla = pow(((double)$this->pantalla), 2);
    }

    public function sin() {
        $this->igual();
        $this->pantalla = sin((double)$this->pantalla);
    }

    public function asin() {
        $this->igual();
        $this->pantalla = asin((double)$this->pantalla);
    }

    public function cos() {
        $this->igual();
        $this->pantalla = cos((double)$this->pantalla);
    }

    public function acos() {
        $this->igual();
        $this->pantalla = acos((double)$this->pantalla);
    }

    public function tan() {
        $this->igual();
        $this->pantalla = tan((double)$this->pantalla);
    }

    public function atan() {
        $this->igual();
        $this->pantalla = atan((double)$this->pantalla);
    }

    public function squareRoot() {
        $this->igual();
        $this->pantalla = sqrt((double)$this->pantalla);
    }
    public function exponencialTen(){
        $this->igual();
        $this->pantalla = pow(10, (double)$this->pantalla);
    }
    public function log(){
        $this->igual();
        $this->pantalla = log((double)$this->pantalla);
    }
    public function exp(){
        $this->igual();
        $this->pantalla = exp((double)$this->pantalla);
    }
    public function fact() {
        $this->igual();
        $this->pantalla = $this->nFact(intval($this->pantalla), 1);
    }
    public function nFact($n, $acc) {
        if ($n == 0 || $n == 1) {
            return $acc; 
        }
        else
        {
            return $this->nFact($n-1, $acc*$n);
        }
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
$calculadora = new CalculadoraCientifica($resultado, $memoria);


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
} else if (isset($_POST['pi'])) {
	$calculadora->pi();
} else if (isset($_POST['cuadrado'])) {
	$calculadora->cuadrado();
} else if (isset($_POST['sin'])) {
	$calculadora->sin();
} else if (isset($_POST['asin'])) {
	$calculadora->asin();
} else if (isset($_POST['cos'])) {
    $calculadora->cos();
} else if (isset($_POST['acos'])) {
    $calculadora->acos();
} else if (isset($_POST['tan'])) {
    $calculadora->tan();
} else if (isset($_POST['atan'])) {
    $calculadora->atan();
} else if (isset($_POST['sqrt'])) {
    $calculadora->squareRoot();
} else if (isset($_POST['exponentialTen'])) {
    $calculadora->exponencialTen();
} else if (isset($_POST['log'])) {
    $calculadora->log();
} else if (isset($_POST['exp'])) {
    $calculadora->exp();
} else if (isset($_POST['fact'])) {
    $calculadora->fact();
} else if (isset($_POST['power'])) {
    $calculadora->operador('**');
} else if (isset($_POST['backspace'])) {
    $calculadora->backspace();
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
                <th colspan='5'><p>Resultado:</p>
                <input type='text' name='pantalla' title='resultado' value='$resultado' readonly/></th> 
            </tr>
            <tr>
                <td><input type='submit' class='memoria' name='mrc' value='mrc'/> </td>
                <td><input type='submit' class='memoria' name='mMenos' value='m-'/> </td>
                <td><input type='submit' class='memoria' name='mMas' value='m+'/> </td>
                <td><!--columna vacía/>--> </td>
			    <td><!--columna vacía/>--> </td>
            </tr>
            <tr>
                <td><!--columna vacía/>--> </td>
                <td><!--columna vacía/>--> </td>
                <td><input type='submit' class='operador' name='sin' value='sin' /> </td>
                <td><input type='submit' class='operador' name='cos' value='cos' /> </td>
                <td><input type='submit' class='operador' name='tan' value='tan' /> </td>
            </tr>
            <tr>
                <td><input type='submit' class='operador' name='cuadrado' value='x&#50' /> </td>
                <td><input type='submit' class='operador' name='power' value='x^y' /> </td>
                <td><input type='submit' class='operador' name='asin' value='asin' /> </td>
                <td><input type='submit' class='operador' name='acos' value='acos' /> </td>
                <td><input type='submit' class='operador' name='atan' value='atan' /> </td>
            </tr>
            <tr>
                <td><input type='submit' class='operador' name='sqrt' value='√' /> </td>
                <td><input type='submit' class='operador' name='exponentialTen' value='10^x' /> </td>
                <td><input type='submit' class='operador' name='log' value='log' /> </td>
                <td><input type='submit' class='operador' name='exp' value='exp' /> </td>
                <td><input type='submit' class='operador' name='operador' value='%' /> </td>
            </tr>
            <tr>
                <td><!--columna vacía/>--> </td>
                <td><!--columna vacía/>--> </td>
                <td><input type='submit' class='operador' name='backspace' value='⊲' /> </td>
                <td><input type='submit' class='operador' name='borrar' value='C' /> </td>
                <td><input type='submit' class='operador' name='operador' value='/' /> </td>
            </tr>
            <tr>
                <td><input type='submit' class='operador' name='pi' value='π' /> </td>
                <td><input type='submit' class='digito' name='digito' value='7' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='8' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='9' /> </td>
                <td><input type='submit' class='operador' name='operador' value='*' /> </td> 
            </tr> 
            <tr>
                <td><input type='submit' class='operador' name='fact' value='n!' /> </td>
                <td><input type='submit' class='digito' name='digito' value='4' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='5' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='6' /> </td> 
                <td><input type='submit' class='operador' name='operador' value='-'/> </td> 
            </tr>

            <tr>
                <td><!--columna vacía/>--> </td>
                <td><input type='submit' class='digito' value='1' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='2' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='3' name='digito'/> </td>
                <td><input type='submit' class='operador' value='+' name='operador'/> </td>
            </tr>
                 
            </tr>

            <tr>
                <td><input type='submit' class='operador' name='digito' value='('/> </td> 
                <td><input type='submit' class='operador' name='digito' value=')'/> </td> 
                <td><input type='submit' class='digito' value='0' name='digito'/> </td>
                <td><input type='submit' class='digito' value='.' name='operador'/> </td> 
                <td><input type='submit' class='igual' value='=' name='igual'/> </td>    
            </tr> 
        </table>
        <input type='text' name='memoria' class = 'memoria' title='memoria' value='$memoria' />
      </form>
      
    ";
    