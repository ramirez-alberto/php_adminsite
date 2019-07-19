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

        if($email && $contrasena){
            if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
                $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);
                $db->prepararConsulta("SELECT nombre,apellido FROM usuarios where contrasena='$contrasena' AND email = '$email'");
                $db->resultado()->bind_result($nombre,$apellido);
                $db->ejecutarConsulta();
                

                    if($db->fetchConsulta()){
                        $exito=TRUE;
                        echo "Exito";
                        
                    }else{
                        
                        trigger_error("La contraseña o el email es incorrecto.",E_USER_NOTICE);
                        
                    }

               

                $db->conn->close();

            }else{
                trigger_error("No es un email valido, intenta nuevamente.",E_USER_NOTICE);
            }

        }

     } 
 
 
 ?>

<?php if($exito):?>



    <?php else:?>

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="helpId" placeholder="El email">
                <div class="form-group">
                    <label for="contrasena">Password</label>
                    <input type="password" class="form-control" name="contrasena" placeholder="La contraseña">
                </div>
                <button type="submit" class="btn btn-primary float-left">Submit</button>
                <a href="registrarse.php" class="float-right">Aun no registrado?</a>
            </div>
        </form>
    </div>
</div>


    <?php endif;?>




<?php require './inc/footer.php'; ?>