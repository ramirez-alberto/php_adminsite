<?php require './inc/header.php'; 
      require './lib/config.php'; 

spl_autoload_register(function ($class) {
    require "./lib/$class.php";
  });

$exito=FALSE;
?>

 <?php
     if($_POST){
        extract($_POST, EXTR_OVERWRITE);

        $email = strtolower($email);

        if($email && $contrasena){
            if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
                $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);
                $db->prepararConsulta("SELECT nombre,apellido,email,contrasena,ruta_imagen FROM usuarios where contrasena='$contrasena' AND email = '$email'");
                $db->ejecutarConsulta();
                $db->resultado()->bind_result($dbnombre,$dbapellido,$dbemail,$dbcontrasena,$dbruta_imagen);
                $db->fetchConsulta();

                $dbnombre = strtolower($dbnombre);
                $dbemail = strtolower($dbemail);

                    if( $dbcontrasena == $contrasena && $dbemail == $email){
                        $exito=TRUE;
                        $db->conn->close();
                        
                    }else{
                        
                        trigger_error("La contraseña o el email es incorrecto.",E_USER_ERROR);
                        
                    }

               

                

            }else{
                trigger_error("No es un email valido, intenta nuevamente.",E_USER_ERROR);
            }

        }

     } 
 
 
 ?>

<?php if($exito):?>

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
        <img class='img-fluid' src="<?php echo $dbruta_imagen; ?>" alt="">
    </div>
</div>

    <?php else:
        header("Location: index.php");
         endif;?>

<?php require './inc/footer.php'; ?>