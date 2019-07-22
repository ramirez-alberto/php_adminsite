<?php 
      session_start();
      require './inc/header.php'; 
      require './lib/config.php'; 

spl_autoload_register(function ($class) {
    require "./lib/$class.php";
  });


?>

 <?php
     if($_POST){
        extract($_POST, EXTR_OVERWRITE);

        $email = strtolower($email);

        if($email && $contrasena){
            if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
                $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);
                $db->prepararConsulta("SELECT idUsuario,concat(nombre,' ',apellido) AS nombreapellido,email,contrasena,ruta_imagen FROM usuarios where contrasena='$contrasena' AND email = '$email'");
                $db->ejecutarConsulta();
                $db->resultado()->bind_result($dbid,$dbnombre,$dbemail,$dbcontrasena,$dbruta_imagen);
                $db->fetchConsulta();

                $dbnombre = strtolower($dbnombre);
                $dbemail = strtolower($dbemail);

                    if( $dbcontrasena == $contrasena && $dbemail == $email){

                        $_SESSION['id_usuario'] = $dbid;
                        $_SESSION['nombre'] = ucwords($dbnombre); 
                        $_SESSION{'ruta_imagen'} = $dbruta_imagen;

                        $db->conn->close();
                        header('Location: admin.php');
                        
                    }else{
                        
                        trigger_error("La contraseña o el email es incorrecto.",E_USER_NOTICE);
                        header('Refresh:3;url=index.php');
                        
                    }

               

                

            }else{
                trigger_error("No es un email valido, intenta nuevamente.",E_USER_NOTICE);
                header('Refresh:3;url=index.php');
            }

        }else{
            trigger_error("Completa los datos para ingresar",E_USER_NOTICE);
            header("Refresh:3; url=index.php");
        }

     } 
 
 
 ?>


<?php require './inc/footer.php'; ?>