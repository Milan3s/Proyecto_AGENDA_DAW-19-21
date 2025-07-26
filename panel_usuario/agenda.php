<?php
session_start();
require_once '../back_end/conexion_de_bbdd/config_bd.php';
if (!isset($_SESSION["usuario"])) {
    header("Location: ../area_no_permitida/restringida.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../front-end/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../front-end/img/favicon.png">
    <title>Agenda</title>
    <link rel="stylesheet" href="../front-end/font_awesome/css/font-awesome.css">
    <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <!-- CSS Files -->

    <link rel="stylesheet" href="../front-end/dataTables/css/dataTables.material.css">
    <link rel="stylesheet" href="../front-end/custom.css">
</head>

<body class="body-proyecto">
<div class="loader">
    <span class="personalizar-cargando">Cargando página...</span><img class="thumb" src="../front-end/logos/loader_v1.gif" />
  </div>
    <nav class="navbar navbar-expand-lg bg-blue py-3" id="color-texto">
        <div class="container">
            <a class="navbar-brand text-white" href="https://demos.creative-tim.com/material-kit/presentation" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                <img class="logos" src="../front-end/logos/LogoAgenda.png" alt=""> 
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto fuente-menu">

                    <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                        <a class="nav-link ps-3 d-flex cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog icons-menu"></i>
                            Agenda
                            <img src="../front-end/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">

                        </a>
                        <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
                            <div class="d-none d-lg-block">
                                <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                    Info
                                </h6>
                                <a href="inicio.php" class="dropdown-item border-radius-md">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Inicio
                                </a>

                                <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1 mt-3">
                                    Opciones
                                </h6>
                                <a href="../back_end/cerrar_sesion/logout.php" class="dropdown-item border-radius-md">
                                    Cerrar Sesión
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item my-auto ms-3 ms-lg-0">
                        <a href="" class="btn btn-sm  bg-gradient-success  mb-0 me-1 mt-2 mt-md-0"> <?php echo $_SESSION["usuario"]; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección Agenda -->
    <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="col-12 mx-auto col-lg-12">
                <div class="row justify-content-center">
                  <div class="row">
                    <div class="col-12 my-5">
                      <div class="card bajar-tabla-col">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                          <div class="bg-gradient-info shadow-info border-radius-lg pt-1">
                            <div class="centrar-agregar">
                              <h5 class="titulo-admin pb-4">Ver Agenda</h5>
                            </div>
                          </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                          <div class="alinear_tabla">
                            <table class="table align-items-center justify-content-center mb-0 display" id="tabla_agenda">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Versión</th>
                                <th>Foto</th>
                              </thead>
                              <tbody class="alinear_tabla_contactos">
                                <?php
                                try {
                                  $query_dispositivos = $bd->query("SELECT id_dispositivo AS id_dispositivo,
                                        nombre AS nombre,descripcion AS descripcion, version AS version,
                                        marca AS marca,foto_dispositivo as foto_dispositivo FROM dispositivo;");
                                  $dispositivos = $query_dispositivos->fetchAll(PDO::FETCH_ASSOC);

                                  foreach ($dispositivos as $dispositivos_moviles) {
                                ?>
                                    <tr>
                                      <td><?php echo $dispositivos_moviles['id_dispositivo']; ?></td>
                                      <td><?php echo $dispositivos_moviles['nombre']; ?></td>
                                      <td><?php echo $dispositivos_moviles['descripcion']; ?></td>
                                      <td><?php echo $dispositivos_moviles['version']; ?></td>
                                      <td><?php echo $dispositivos_moviles['marca']; ?></td>
                                      <td><img class="img-foto-insertar-dispositivo" src="../subida_de_archivos/<?php echo $dispositivos_moviles['foto_dispositivo']; ?>" alt=""></td>
                                    </tr>
                                <?php
                                  }
                                } catch (PDOException $e) {
                                  echo "No se encontraron datos : " . $e->getMessage();
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

        <!--   Core JS Files   -->
        <script src="../front-end/js/jquery-3.6.0.min.js"></script>
        <script src="../front-end/js/core/popper.min.js" type="text/javascript"></script>
        <script src="../front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
        <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
        <script src="../front-end/js/plugins/parallax.min.js"></script>
        <script src="../front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>
        <script src="../front-end/js/jquery.dataTables.min.js"></script>
        <script src="../front-end/custom.js"></script>
        <script src="../front-end/datables_custom.js"></script>
        <script src="../front-end/preloader-custom.js"></script>

</body>

</html>