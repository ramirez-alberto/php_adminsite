<?php 
session_start();


if(!$_SESSION['id_usuario'] && !$_SESSION['nombre']){
    header('Location: index.php');
    exit;
}
$caduca = time()-100;

if(isset($_COOKIE['nombre'])){
  setcookie('id',$_SESSION['id_usuario'],$caduca ) ;
  setcookie('nombre',$_SESSION['nombre'],$caduca ) ;
  setcookie('imagen',$_SESSION{'ruta_imagen'},$caduca) ;
}

session_unset();
session_destroy();






header('Refresh:3; url = index.php');

require './inc/header.php';

?>

<div class="row text-center">
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
      <h3>Haz cerrado sesion, seras redireccionado a la pagina de login.</h3>
  </div>
</div>


<?php require './inc/footer.php'; ?>