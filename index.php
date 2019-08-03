<?php
session_start();
if ((isset($_SESSION['id_usuario']) && isset($_SESSION['nombre'])) || isset($_COOKIE['nombre'])) {

    if (isset($_COOKIE['nombre'])) {
        $_SESSION['id_usuario'] = $_COOKIE['id'];
        $_SESSION['nombre'] = $_COOKIE['nombre'];
        $_SESSION['ruta_imagen'] = $_COOKIE['imagen'];
    }
    header('Location: admin.php');
    exit;
}

require './inc/header.php';
?>


<!--HTML------------------------------------------------------------------------------- -->
<div class="row">
            <div class="col-sm-12 text-center">

                <h1>Portal WEB</h1>

            </div>
        </div>

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
        <form action="login.php" method="post">
            <legend>Inicio</legend>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="helpId" placeholder="El email">
                <div class="form-group">
                    <label for="contrasena">Password</label>
                    <input type="password" class="form-control" name="contrasena" placeholder="La contraseña">
                </div>
                <button type="submit" class="btn btn-primary float-left">Submit</button>
                <a href="registrarse.php" class="float-right">Aun no registrado?</a>
                <label for="" class="checkbox-inline">
                    <input type="checkbox" name="mantener" value="valido">&nbsp&nbsp Mantener sesion iniciada.
                </label>

            </div>
        </form>
    </div>
</div>


<!-- ------------------------------------------------------------------------------- -->



<?php require './inc/footer.php'; ?>