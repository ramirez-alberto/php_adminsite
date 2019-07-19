<?php

$a = 5;    #int
$b = 6.1;    #double
$c = "un string";    #string
$d = NULL;    #null
$e = FALSE;    #boolean

$f = [1,2,3,"un array","hola" => "mundo"];#array dimensional y asociativo

var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);

foreach($f as $y => $z):
    echo "$y : $z";
endforeach;

echo "{$f["hola"]} <br>";

define("COLA","la mia");
echo COLA;

class unaClase{

    public $ab=6;
    private $b=5;
    protected $c = 4;

    public function __construct($var1=5)
    {
        echo "La variable es $var1";
    }


}

class otraClase extends unaClase{ }

$prueba = new otraClase();
echo $prueba->ab;
#echo $prueba -> c;