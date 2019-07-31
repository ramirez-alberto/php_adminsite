<?php

$conn = new mysqli($host= 'localhost',$username ='prueba' , $passwd ='prueba' , $dbname ='portal', $port = '3306');

$prep = $conn->prepare("INSERT INTO usuarios (idUsuario, nombre,apellido, dni, contrasena, telefono, email) 
VALUES (NULL,'Matt','Damon',123456,'unacontra',1234567,'abc@gmail.com')");

$prep->execute();


/* $prep ->bind_result($apellido);



   
  

var_dump($prep->num_rows);

while($prep->fetch()){
    echo $apellido;
} */



$conn->close();
/*foreach( get_class_methods($conn) as $x){
    echo "$x <br>";
}*/
$bandera = false;
echo $bandera;


?>