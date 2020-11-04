<?php 

interface Operation {
  public function operate();
  public function getEquation(); 
}

abstract class twoValueOperation implements Operation {
  protected $operand_1;
  protected $operand_2;
  public function __construct($o1, $o2) {
    // Make sure we're working with numbers...
    if (!is_numeric($o1) || !is_numeric($o2)) {
      throw new Exception('Non-numeric operand.');
    }
    
    // Assign passed values to member variables
    $this->operand_1 = $o1;
    $this->operand_2 = $o2;
  }
}

abstract class oneValueOperation implements Operation {
  protected $operand_1;
  public function __construct($o1) {
    // Make sure we're working with numbers...
    if (!is_numeric($o1)) {
      throw new Exception('Non-numeric operand.');
    }
    
    // Assign passed values to member variables
    $this->operand_1 = $o1;
  }
}

class Log extends oneValueOperation {
  public function operate() {
    return log($this->operand_1, 10);
  }
  
  public function getEquation() {
    return 'log(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

class NatLog extends oneValueOperation {
  public function operate() {
    return log($this->operand_1);
  }

  public function getEquation() {
    return 'ln(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

class Addition extends twoValueOperation {
  public function operate() {
    return $this->operand_1 + $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Subtraction extends twoValueOperation {
  public function operate() {
    return $this->operand_1 - $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Multiplication extends twoValueOperation {
  public function operate() {
    return $this->operand_1 * $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Division extends twoValueOperation {
  public function operate() {
    return $this->operand_1 / $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class TenToX extends oneValueOperation {
  public function operate() {
    return pow(10, $this->operand_1);
  }
  public function getEquation() {
    return '10^' . $this->operand_1 . ' = ' . $this->operate();
  }
}
class EToX extends oneValueOperation {
  public function operate() {
    return pow(M_E, $this->operand_1);
  }
  public function getEquation() {
    return 'e^' . $this->operand_1 . ' = ' . $this->operate();
  }
}

class Sin extends oneValueOperation {
  public function operate() {
    return sin($this->operand_1);
  }
  public function getEquation() {
    return "sin(" . $this->operand_1 . ') = ' . $this->operate();
  }
}

class Cos extends oneValueOperation {
  public function operate() {
    return cos($this->operand_1);
  }
  public function getEquation() {
    return "cos(" . $this->operand_1 . ') = ' . $this->operate();
  }
}

class Tan extends oneValueOperation {
  public function operate() {
    return tan($this->operand_1);
  }
  public function getEquation() {
    return "tan(" . $this->operand_1 . ') = ' . $this->operate();
  }
}


class SquareRoot extends oneValueOperation{
  public function operate(){
    return sqrt($this->operand_1);
  }
  public function getEquation(){
    return 'square root of ' . $this->operand_1 . ' = ' . $this->operate();
  }
  
}


class Square extends oneValueOperation{
  public function operate(){
    return pow($this->operand_1, 2);
  }
  public function getEquation(){
    return  $this->operand_1 . '^2 = ' . $this->operate();
  }
  
}

class XToY extends twoValueOperation{
  public function operate() {
    return pow($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return $this->operand_1 . '^' . $this->operand_2 . ' = ' . $this->operate();
  }
  
}

// Some more interesting useful math functions
// Arc triangle functions
class Abs extends oneValueOperation {
  public function operate() {
    return abs($this->operand_1);
  }
  public function getEquation() {
    return "abs(" . $this->operand_1 . ') = ' . $this->operate();
  }
}


class ASin extends oneValueOperation {
  public function operate() {
    return asin($this->operand_1);
  }
  public function getEquation() {
    return "asin(" . $this->operand_1 . ') = ' . $this->operate();
  }
}

class ACos extends oneValueOperation {
  public function operate() {
    return acos($this->operand_1);
  }
  public function getEquation() {
    return "acos(" . $this->operand_1 . ') = ' . $this->operate();
  }
}

class ATan extends oneValueOperation {
  public function operate() {
    return atan($this->operand_1);
  }
  public function getEquation() {
    return "atan(" . $this->operand_1 . ') = ' . $this->operate();
  }
}


// Check to make sure that POST was received 
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Instantiate an object for each operation based on the values returned on the form
  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    } else if(isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtraction($o1, $o2);
    } else if(isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiplication($o1, $o2);
    } else if(isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
      $op = new Division($o1, $o2);
    } else if(isset($_POST['sqrt']) && $_POST['sqrt'] == 'Sqrt') {
      $op = new SquareRoot($o1);
    } else if(isset($_POST['xtt']) && $_POST['xtt'] == 'Square') {
      $op = new Square($o1);
    } else if(isset($_POST['xty']) && $_POST['xty'] == 'X ^ Y') {
      $op = new XToY($o1, $o2);
    } else if(isset($_POST['log']) && $_POST['log'] == 'Log') {
      $op = new Log($o1);
    } else if(isset($_POST['ln']) && $_POST['ln'] == 'Ln') {
      $op = new NatLog($o1);
    } else if(isset($_POST['ttx']) && $_POST['ttx'] == '10^x') {
      $op = new TenToX($o1);
    } else if(isset($_POST['etx']) && $_POST['etx'] == 'e^x') {
      $op = new EToX($o1);
    } else if(isset($_POST['sin']) && $_POST['sin'] == 'Sin') {
      $op = new Sin($o1);
    } else if(isset($_POST['cos']) && $_POST['cos'] == 'Cos') {
      $op = new Cos($o1);
    } else if(isset($_POST['tan']) && $_POST['tan'] == 'Tan') {
      $op = new Tan($o1);
    } else if(isset($_POST['asin']) && $_POST['asin'] == 'ASin') {
      $op = new ASin($o1);
    } else if(isset($_POST['acos']) && $_POST['acos'] == 'ACos') {
      $op = new ACos($o1);
    } else if(isset($_POST['atan']) && $_POST['atan'] == 'ATan') {
      $op = new ATan($o1);
    } else if(isset($_POST['abs']) && $_POST['abs'] == 'Abs') {
      $op = new Abs($o1);
    } 
  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
<title>PHP Calculator</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="lab7.js"></script>
<link rel="stylesheet" href="lab7.css">

</head>
<body class="container">
<div id="calculator" class = "card">
<div class = "card-body">
  <pre id="result">
  <?php 
    if (isset($op)) {
      try {
        echo "<h3>". $op->getEquation(). "</h3><br>";
      }
      catch (Exception $e) { 
        $err[] = $e->getMessage();
      }
    }

    foreach($err as $error) {
        echo $error . "\n";
    } 
  ?>

  </pre>
  <form method="post" action="calculator.php">
    <div id="input-field">
      <input type="text" name="op1" id="name" value="" />
      <input id="right-field" type="text" name="op2" id="name" value="" />
    </div>
    <br/>
    <div class="buttonGroup">
      <input class="btn btn-secondary operation" type="submit" name="add" value="Add" />  
      <input class="btn btn-secondary operation" type="submit" name="sub" value="Subtract" /> 
      <input class="btn btn-secondary operation" type="submit" name="mult" value="Multiply" />  
      <input class="btn btn-secondary operation" type="submit" name="divi" value="Divide" />
    </div>
    <div class="buttonGroup">
      <input class="btn btn-secondary operation" type="submit" name="log" value="Log" />
      <input class="btn btn-secondary operation" type="submit" name="ln" value="Ln" />
      <input class="btn btn-secondary operation" type="submit" name="ttx" value="10^x" />  
      <input class="btn btn-secondary operation" type="submit" name="etx" value="e^x" />
    </div>
    <div class="buttonGroup">
      <input class="btn btn-secondary operation" type="submit" name="sin" value="Sin" />  
      <input class="btn btn-secondary operation" type="submit" name="cos" value="Cos" />  
      <input class="btn btn-secondary operation" type="submit" name="tan" value="Tan" />
      <input class="btn btn-secondary operation" type="submit" name="xty" value="X ^ Y" />
    </div>
    <div class="buttonGroup">
      <input class="btn btn-secondary operation" type="submit" name="asin" value="ASin" />  
      <input class="btn btn-secondary operation" type="submit" name="acos" value="ACos" />  
      <input class="btn btn-secondary operation" type="submit" name="atan" value="ATan" />
      <input class="btn btn-secondary operation" type="submit" name="abs" value="Abs" />
    </div>
    <div class="buttonGroup">
      <input class="btn btn-secondary operation" type="submit" name="sqrt" value="Sqrt" />
      <input class="btn btn-secondary operation" type="submit" name="xtt" value="Square" />
      <input id="Result" class="btn btn-secondary result-operation" name="Result" value="Result" />
    </div>
    
    
    
  </form>
  </div>
</div>
</body>
</html>

