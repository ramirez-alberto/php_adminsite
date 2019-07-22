<?php 
session_start();
 if(!$_SESSION['id_usuario'] && !$_SESSION['nombre']){
     header('Location: index.php');
     exit;
 }
    require './inc/header.php';

  ?>

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
        <h2>Bienvenido <?php echo $_SESSION['nombre'];?></h2>
        <img class='img-fluid' src="<?php echo $_SESSION['ruta_imagen']; ?>" alt="">
        <a href="logout.php"  class="btn btn-primary">Cerrar sesion</a>
    </div>
</div>


<?php require './inc/footer.php'; ?>