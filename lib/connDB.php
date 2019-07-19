<?php

class connDB
{

    public $conn;
    protected $resultado;
    protected $consulta;


    public function __construct($host, $username, $passwd, $dbname, $port)
    {
        $this->conn = new mysqli($host, $username, $passwd, $dbname, $port);

        if ($this->conn->connect_errno) {
            trigger_error("Tipo de error ( {$this->conn->connect_error})", E_USER_ERROR);
        }

        $this->conn->set_charset('utf8');
    }

    public function prepararConsulta($consulta)
    {
        $this->consulta = $consulta;
        $this->resultado = $this->conn->prepare($consulta);
        if (!$this->resultado) {
            trigger_error("Error al preparar consulta", E_USER_WARNING);
            exit();
        }else{return true;}
        
    }

    public function ejecutarConsulta()
    {
        
       $this->resultado->execute();
          
    }

    public function resultado(){
        return $this->resultado;
    }


    /* public function bindConsulta(){
        $this->resultado->bind_result($apellido);
    } */
    public function fetchConsulta()
    {
        return $this->resultado->fetch();
    }

    public function cambiarBD($bd){
        $this->conn->select_db($bd);
        return true;
    }

    public function filtraConsulta( $columna, $tabla, $condicion)
    {
        $this->resultado = $this->conn->query("SELECT $columna FROM $tabla WHERE $columna = $condicion");
        $checale =  $this->resultado->num_rows;
        return $checale;
    }
    
}
