<?php 
session_start();
 if(!$_SESSION['id_usuario'] && !$_SESSION['nombre']){
     header('Location: index.php');
     exit;
 }
 require './lib/config.php'; 
 require './inc/header.php';

 spl_autoload_register(function ($class) {
     require "./lib/$class.php";
   });


  ?>

<!--HTML------------------------------------------------------------------------------- -->

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-centro caja">
        <div class="row ">
            <h2>Bienvenido <?php echo $_SESSION['nombre'];?></h2>
            <img class='img-fluid' src="<?php echo $_SESSION['ruta_imagen']; ?>" alt="">
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <tbody>
<!--PHP------------------------------------------------------------------------------- -->                
                <?php

                        $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);
                        $db->prepararConsulta("SELECT concat(nombre,' ',apellido) AS nombreapellido,dni,email,telefono 
                                                FROM usuarios 
                                                LIMIT 5");
                        $db->ejecutarConsulta();
                        $db->resultado()->bind_result($dbnombre,$dbdni,$dbemail,$dbtelefono);
                        
                        $counter = 1;
                        
                        while($db->fetchConsulta()){
                            echo "<tr>
                                    <th scope='row'>$counter</th>
                                    <td>$dbnombre</td>
                                    <td>$dbdni</td>
                                    <td>$dbemail</td>
                                    <td>$dbtelefono</td>
                                    </tr>"
                                ;
                            $counter ++;
                        }
                        $db->conn->close();
                    ?>
<!--HTML------------------------------------------------------------------------------- -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<!--PHP------------------------------------------------------------------------------- -->
<?php require './inc/footer.php'; ?>