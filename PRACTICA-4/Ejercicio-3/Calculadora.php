class Calculadora {
    protected $pantalla="";
    
    public function __construct($val){
        $this->pantalla=$val;
    }
    public function display( $val ) {  
        $this->pantalla .= $val;
    }

    public function digitos($digito){
        if ($this->pantalla=='0') {
            $this->pantalla='';
        }
        $this->display($digito);
    }
    public function operador($op)  {
        if ($this->pantalla=="") {
            $this->borrar();
            return;
        }
        $this->display($op);
    }

    public function borrar(){
        $this->pantalla = "";
    }

    public function igual(){
		if(strlen($this->pantalla)){
			try {
				$this->pantalla = eval("return ".$this->pantalla.";");
			} catch (Exception $e) {
				$this->pantalla = "Error ".$e->getMessage();
                return;
			}
		}
    }

    public function ver() {
        return  $this->pantalla;
    }
    
}


class CalculadoraCientifica extends Calculadora{
    
    // constructor
    public function __construct($val){
        parent::__construct($val);
    }

    public function pi() {
        $this->pantalla = M_PI;
        
    }
}

class PilaLifo extends CalculadoraCientifica{
    // constructor
    protected $pila;
    public function __construct($displayPila, $val){
        parent::__construct($val);
        if ($displayPila=="") {
            $this->pila = array();
        } else {
            $this->pila = array_reverse(explode('#', $displayPila));
        }
    }

    public function push($valor){
        array_push($this->pila, $valor);
    }
    public function pop(){
        return array_pop($this->pila);
    }
    public function enter(){
        $this->push(((double)$this->pantalla));
        $this->borrar();
    }

    public function mostrar(){
        $n = count($this->pila);
        $stringPila="";
        for ($i=$n-1; $i>=0; $i--) {
            if ($i==$n-1) {
                $stringPila=$this->pila[$i];
            } else {
                $stringPila=$stringPila.'#'.$this->pila[$i];
            }
        }
        return $stringPila;
    }

    public function sumar(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(((double)$this->pop()) + ((double)$this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
       
    }

    public function restar(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push((double)$this->pop() - (double)$this->pop());
        }catch(Exception $err) {
            echo $err;
        }
       
    }

    public function dividir(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(((double)$this->pop()) / ((double)$this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function multiplicar(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(((double)$this->pop()) * ((double)$this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function sin() {
        try{
            $this->checkPilaStatusOperando();
            $this->push(sin($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function cos(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(cos($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function tan(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(tan($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function cuadrado() {
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(pow(2, $this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }
    public function pow() {
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(pow($this->pop(), $this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function asin() {
        try{
            $this->checkPilaStatusOperando();
            $this->push(asin($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function acos(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(acos($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function atan(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(atan($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function squareRoot(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(sqrt($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function exponencialTen(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(pow(10, $this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function log(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(log($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function exp(){
        try{
            $this->checkPilaStatusOperando();
            $this->push(exp($this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
    }

    public function mod(){
        try{
            $this->checkPilaStatus2Operandos();
            $this->push(((double)$this->pop()) % ((double)$this->pop()));
        }catch(Exception $err) {
            echo $err;
        }
       
    }

    public function fact() {
        try{
            $this->checkPilaStatusOperando();
            $this->push($this->nFact($this->pop(), 1));
        }catch(Exception $err) {
            echo $err;
        }
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

    public function backspace(){
        $this->pop();
    }

    public function checkPilaStatus2Operandos(){
        if(count($this->pila) < 2){
            throw new Exception("El tamaño de la pila debe ser mayor o igual que 2");
        }
    }

    public function checkPilaStatusOperando(){
        if(count($this->pila) < 1){
            throw new Exception("El tamaño de la pila debe de ser 1 al menos");
        }
    }

    public function verPila() {
        return $this->pila;
    }

}



$resultado="";
$displayPila="";
if (isset($_POST['pantalla'])) {
    $resultado=$_POST['pantalla'];
}
if (isset($_POST['stack'])) {
    $displayPila=$_POST['stack'];
}
$calculadora = new PilaLifo($displayPila, $resultado);

if (isset($_POST['digito'])) {
    $calculadora->digitos($_POST['digito']);
} else if (isset($_POST['operador'])) {
    $calculadora->operador($_POST['operador']);
} else if (isset($_POST['borrar'])) {
	$calculadora->borrar();
} else if (isset($_POST['pi'])) {
	$calculadora->pi();
} else if (isset($_POST['ENTER'])) {
    $calculadora->enter();
} else if (isset($_POST['sumar'])) {
    $calculadora->sumar();
} else if (isset($_POST['restar'])) {
    $calculadora->restar();
} else if (isset($_POST['dividir'])) {
    $calculadora->dividir();
} else if (isset($_POST['multiplicar'])) {
    $calculadora->multiplicar();
} else if (isset($_POST['sin'])) {
	$calculadora->sin();
} else if (isset($_POST['cos'])) {
	$calculadora->cos();
} else if (isset($_POST['tan'])) {
	$calculadora->tan();
} else if (isset($_POST['cuadrado'])) {
	$calculadora->cuadrado();
} else if (isset($_POST['power'])) {
    $calculadora->pow();
} else if (isset($_POST['asin'])) {
	$calculadora->asin();
} else if (isset($_POST['acos'])) {
    $calculadora->acos();
} else if (isset($_POST['atan'])) {
    $calculadora->atan();
} else if (isset($_POST['sqrt'])) {
    $calculadora->squareRoot();
} else if (isset($_POST['exponentialTen'])) {
    $calculadora->exponencialTen();
} else if (isset($_POST['log'])) {
    $calculadora->log();
} else if (isset($_POST['mod'])) {
    $calculadora->mod();
} else if (isset($_POST['exp'])) {
    $calculadora->exp();
} else if (isset($_POST['fact'])) {
    $calculadora->fact();
}  else if (isset($_POST['backspace'])) {
    $calculadora->backspace();
}

$displayPila = $calculadora->mostrar();
$resultado=$calculadora->ver();
$textPila=str_replace("#", "\n", $displayPila);

// Interfaz con el usuario. 
echo "
        <!-- Tabla donde se muestra la calculadora-->
      <form method='post' name='calculadora'>
        <table>
            <tr>
                <th colspan='5'>
                <label for='pantalla'>Resultado:</label>
                <textarea rows='4' cols='50' readonly>
                   $textPila
                </textarea>
                <input type='text' id='pantalla' name='pantalla' title='resultado' value='$resultado' readonly/></th> 
              </th> 
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
                <td><input type='submit' class='operador' name='mod' value='%' /> </td>
            </tr>
            <tr>
                <td><!--columna vacía/>--> </td>
                <td><!--columna vacía/>--> </td>
                <td><input type='submit' class='operador' name='backspace' value='⊲' /> </td>
                <td><input type='submit' class='operador' name='borrar' value='C' /> </td>
                <td><input type='submit' class='operador' name='dividir' value='/' /> </td>
            </tr>
            <tr>
                <td><input type='submit' class='operador' name='pi' value='π' /> </td>
                <td><input type='submit' class='digito' name='digito' value='7' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='8' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='9' /> </td>
                <td><input type='submit' class='operador' name='multiplicar' value='*' /> </td> 
            </tr> 
            <tr>
                <td><input type='submit' class='operador' name='fact' value='n!' /> </td>
                <td><input type='submit' class='digito' name='digito' value='4' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='5' /> </td> 
                <td><input type='submit' class='digito' name='digito' value='6' /> </td> 
                <td><input type='submit' class='operador' name='restar' value='-'/> </td> 
            </tr>

            <tr>
                <td><!--columna vacía/>--> </td>
                <td><input type='submit' class='digito' value='1' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='2' name='digito'/> </td> 
                <td><input type='submit' class='digito' value='3' name='digito'/> </td>
                <td><input type='submit' class='operador' value='+' name='sumar'/> </td>
            </tr>
                 
            </tr>

            <tr>
                <td><!--columna vacía/>--> </td>
                <td><!--columna vacía/>--> </td> 
                <td><input type='submit' class='digito' value='0' name='digito'/> </td>
                <td><input type='submit' class='digito' value='.' name='operador'/> </td> 
                <td><input type='submit' class='enter' value='ENTER' name='ENTER'/> </td>    
            </tr> 
        </table>
        <input type='text' name='stack' value='$displayPila' class = 'oculto'/>
      </form>
      
    ";
    