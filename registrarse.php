<?php require './inc/header.php';
require './lib/validarfoto.php';
require './lib/config.php';


spl_autoload_register(function ($class) {
  require "./lib/$class.php";
});

$bandera = false;


if ($_POST) {
  extract($_POST, EXTR_OVERWRITE);




  $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);
  /*   $db->prepararConsulta("SELECT email FROM usuarios");
  $db->ejecutarConsulta();
  $db->resultado()->bind_result($apellido);

  while ($db->fetchConsulta()) {
    echo $apellido;
  }
  echo $db->filtraConsulta('email', 'usuarios', "'ejemplo@gmail.com'");
 */

  if ($nombre && $contrasena && $confirma_con && $email) {
    if (strlen($contrasena) < 2) {
      echo "La contraseña debe ser mayor a 8 caracteres<br>";
    } else {
      if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
        if ($contrasena === $confirma_con) {

          if ($db->filtraConsulta('email', 'usuarios', "'$email'") == 1) {
            echo "Este email ya se encuentra registrado";
          } else {
            if (!file_exists('fotos')) {
              mkdir('fotos', 0777);
            }

            if (validarFoto($nombre)) {

              if ($db->prepararConsulta("INSERT INTO usuarios 
              VALUES
               (NULL,'$nombre', '$apellido', $dni, '$contrasena', $telefono, '$email')")) {
                $db->ejecutarConsulta();
                trigger_error("Te has registrado",E_USER_NOTICE);
                $bandera = true;
              }
            }
          }
        } else {
          echo "Las contraseñas no coinciden, intenta nuevamente<br>";
        }
      } else {
        echo "Ingresa un email valido <br>";
      }
    }
  } else {
    echo "Rellena los campos <br>";
  }
  $db->conn->close();
}




?>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
    <?php if ($bandera) : ?>
      <h1>Saludos <?php echo $nombre ?></h1>
      <img class='img-fluid' src=<?php echo " {$dirImg}profile.jpg"; ?> alt=''>
      <a href='misitio.php'>Regresar al inicio..</p>


    <?php else : ?>
      <form action="" method="post" enctype="multipart/form-data">
        <legend>Registrarse</legend>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" class="form-control" name="apellido" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña</label>
          <input type="password" class="form-control" name="contrasena" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="form-group">
          <label for="confirma_con">Confirma la contraseña</label>
          <input type="password" class="form-control" name="confirma_con" id="" aria-describedby="helpId" placeholder="Repite la contraseña">

        </div>
        <div class="form-group">
          <label for="dni">DNI</label>
          <input type="text" class="form-control" name="dni" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="form-group">
          <label for="telefono">Telefono</label>
          <input type="text" class="form-control" name="telefono" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input type="file" class="form-control-file" name="imagen" id="" placeholder="Una imagen" aria-describedby="fileHelpId">

        </div>


        <button type="submit" class="btn btn-primary float-left">Submit</button>
        <a href="misitio.php" class="float-right">Regresar al inicio...</a>
      </form>

    </div>
  </div>

  </div>

<?php endif; ?>

<?php require './inc/footer.php'; ?>