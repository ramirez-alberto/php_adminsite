<?php
session_start();
if (!$_SESSION['id_usuario'] && !$_SESSION['nombre']) {
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
<div class="row">
    <div class="col-sm-12 text-center">

        <h1><i class="fa fa-user" aria-hidden="true"></i> Editar o eliminar usuarios</h1>

    </div>
</div>

<div class="row text-center">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 col-centro">
        <div class="row">
            <table class="table">
                
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dni</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Edicion</th>
                    </tr>
                </thead>
                <tbody>
                    <!--PHP------------------------------------------------------------------------------- -->
                    <?php

                    if(isset($_GET['id_usuario'])){
                        

                    }

                    $db = new connDB(HOST, USERNAME, PASSWD, DBNAME, PORT);




                    /*                     Consulta para obtener paginacion  */

                    $db->prepararConsulta("SELECT count(*) 
                                                FROM usuarios ");
                    $db->ejecutarConsulta();
                    $db->resultado()->bind_result($dbcantidad);
                    $db->fetchConsulta();

                    $porPagina = 5;

                    $paginas = ceil($dbcantidad / $porPagina);
                    $pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
                    $iniciar = ($pagina - 1) * $porPagina;

                    $anterior = $pagina - 1;
                    $siguiente = $pagina + 1;


                    $db->liberar();

                    /*                     Consulta para desplegar resultados de usuarios  */

                    $db->prepararConsulta("SELECT idUsuario,concat(nombre,' ',apellido) AS nombreapellido,dni,email,telefono 
                                                FROM usuarios 
                                                LIMIT $iniciar,$porPagina");
                    $db->ejecutarConsulta();
                    $db->resultado()->bind_result($dbid,$dbnombre, $dbdni, $dbemail, $dbtelefono);


                    $counter = $iniciar;

                    while ($db->fetchConsulta()) {
                        echo "<tr>
                                    <th scope='row'>$counter</th>
                                    <td>$dbnombre</td>
                                    <td>$dbdni</td>
                                    <td>$dbemail</td>
                                    <td>$dbtelefono</td>
                                    <td>
                                    
                                    <a href='#' class='btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                    <button onclick='getId($dbid);' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-times' aria-hidden='true'></i></button>
                                    </td>
                                    </tr>";
                        $counter++;
                    }
                    $db->liberar();
                    $db->conn->close();
                    ?>
                    <!--HTML------------------------------------------------------------------------------- -->
                </tbody>
            </table>

                        <!-- Modal -->
                        <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Confirma la accion:</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                ¿Deseas eliminar el siguiente usuario?
                                <p></p>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>

            <nav aria-label="Pagination">
                <ul class="pagination">

                    <?php if (!($pagina <= 1)) : ?>
                        <li class="page-item"><a class="page-link" href=<?php echo "?pagina=$anterior"; ?>>Previous</a></li>
                    <?php endif; ?>

                    <?php
                    for ($x = 1; $x <= $paginas; $x++) {
                        echo ($x == $pagina) ? "<li class='page-item active'><a class='page-link' href='?pagina=$x'>$x</a></li>" : "<li class='page-item'><a class='page-link' href='?pagina=$x'>$x</a></li>";
                    }
                    ?>

                    <?php if (!($pagina >= $paginas)) : ?>
                        <li class="page-item"><a class="page-link" href=<?php echo "?pagina=$siguiente"; ?>>Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</div>

<!--PHP------------------------------------------------------------------------------- -->
<?php require './inc/footer.php'; ?>