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
  <title>Administrador</title>
  <link rel="stylesheet" href="../front-end/font_awesome/css/font-awesome.css">
  <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../front-end/css/material-dashboard.css" rel="stylesheet" />
  <link rel="stylesheet" href="../front-end/dataTables/css/dataTables.material.css">
  <link rel="stylesheet" href="../front-end/custom.css" media="screen">
</head>

<body class="body-proyecto">
  <div class="loader">
    <span class="personalizar-cargando">Cargando página...</span><img class="thumb" src="../front-end/logos/loader_v1.gif" />
  </div>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark menu-aside" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img class="logos" src="../front-end/logos/LogoAgenda.png">
        <span class="ms-1 font-weight-bold text-white">Panel de Admin</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Gestión de Tablas</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active" href="inicio.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-database" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Tablero</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="agenda-y-contactos.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-address-book" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Agenda y Contactos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="usuarios-y-roles.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Usuarios y Roles</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="eventos.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Eventos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="perfil.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user-o" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../back_end/cerrar_sesion/logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Cerrar Sesión</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>



  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl bg-blue py-3 fixed-top mover-admin-menu menu-todos" id="color-texto" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Estás en el </a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Tablero</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <?php
                $foto_usuario = $_SESSION["usuario"];

                $foto_del_usuario = $bd->prepare("SELECT 
                id_usuarios AS id_usuarios,
                foto_usuarios AS foto_usuarios
                FROM usuarios as usuarios 
                WHERE nombre = :nombre");
                $foto_del_usuario->bindParam(":nombre", $foto_usuario);
                $foto_del_usuario->execute();

                $mostrarFoto = $foto_del_usuario->fetchAll(PDO::FETCH_ASSOC);
                try {
                  foreach ($mostrarFoto as $fila_foto) {

                ?>
                    <ul class="navbar-nav  justify-content-end">
                      <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                          <div class="text-center">
                            <img style="width:40px;" src="../subida_de_archivos/<?php echo $fila_foto['foto_usuarios']; ?>">
                          </div>
                          <span class="d-sm-inline d-none"><?php echo $_SESSION["usuario"]; ?></span>
                        </a>
                      </li>
                  <?php
                  }
                } catch (PDOException $sacarFoto) {
                  echo "algo ha ido mal" . $sacarFoto->getMessage();
                }
                  ?>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="container">
          <div class="centrar-panel-de-control">
            <div class="row">
              <div class="col-md-3">
                <div class="card my-5">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="fa fa-mobile" aria-hidden="true"></i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Total de Agendas</p>
                      <?php
                      try {
                        $query_contar_agendas = $bd->query("SELECT COUNT(id_dispositivo) AS id_dispositivo FROM dispositivo");
                        $resultado_query_agendas = $query_contar_agendas->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado_query_agendas as $numero_de_agendas) {
                      ?>
                          <h4 class="mb-0"><?php echo $numero_de_agendas['id_dispositivo']; ?></h4>
                      <?php
                        }
                      } catch (PDOException $conteoAgendas) {
                        echo 'Error al contar datos : ' . $conteoAgendas->getMessage();
                      }

                      ?>
                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-3">
                    <p class="mb-0">Agendas disponibles</p>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card my-5">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="fa fa-address-book" aria-hidden="true"></i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Total de contactos</p>
                      <?php
                      try {
                        $query_contar_contactos = $bd->query("SELECT COUNT(id_contactos) AS id_contactos FROM contactos");
                        $resultado_query_contactos = $query_contar_contactos->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado_query_contactos as $numero_de_contactos) {
                      ?>
                          <h4 class="mb-0"><?php echo $numero_de_contactos['id_contactos']; ?></h4>
                      <?php
                        }
                      } catch (PDOException $conteoContactos) {
                        echo 'Error al contar datos : ' . $conteoContactos->getMessage();
                      }
                      ?>
                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-3">
                    <p class="mb-0">Contactos en la agenda </p>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card my-5">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Total de Eventos </p>
                      <?php
                      try {
                        $query_contar_eventos = $bd->query("SELECT COUNT(id) AS id FROM eventos");
                        $resultado_query_eventos = $query_contar_eventos->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado_query_eventos as $numero_de_eventos) {
                      ?>
                          <h4 class="mb-0"><?php echo $numero_de_eventos['id']; ?></h4>
                      <?php
                        }
                      } catch (PDOException $conteoEventos) {
                        echo 'Error al contar datos : ' . $conteoEventos->getMessage();
                      }
                      ?>
                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-3">
                    Todos los Eventos</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="card my-5">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Total de Usuarios</p>
                      <?php
                      try {
                        $query_contar_usuarios = $bd->query("SELECT COUNT(id_usuarios) AS id_usuarios FROM usuarios");
                        $resultado_query_usuarios = $query_contar_usuarios->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado_query_usuarios as $numero_de_usuarios) {
                      ?>
                          <h4 class="mb-0"><?php echo $numero_de_usuarios['id_usuarios']; ?></h4>
                      <?php
                        }
                      } catch (PDOException $conteoUsuarios) {
                        echo 'Error al contar datos : ' . $conteoUsuarios->getMessage();
                      }
                      ?>
                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-4">
                    <p class="mb-0">Usuarios Disponibles</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card my-5">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Roles de Usuarios</p>
                      <?php
                      try {
                        $query_contar_privilegios = $bd->query("SELECT COUNT(id_rol) AS id_rol FROM rol");
                        $resultado_query_privilegios = $query_contar_privilegios->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado_query_privilegios as $numero_de_privilegios) {
                      ?>
                          <h4 class="mb-0">
                            <?php
                            echo $numero_de_privilegios['id_rol'];

                            ?>
                          </h4>
                      <?php
                        }
                      } catch (PDOException $conteoPrivilegios) {
                        echo 'Error al contar datos : ' . $conteoPrivilegios->getMessage();
                      }
                      ?>


                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer">
                    Roles :
                    <?php
                    try {
                      $query_detalles_privilegios = $bd->query("SELECT privilegios AS privilegios FROM rol");
                      $resultado_query_DetallesPrivilegios = $query_detalles_privilegios->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($resultado_query_DetallesPrivilegios as $detalles) {
                    ?>

                        <span class="text-success text-sm font-weight-bolder"> <?php echo $detalles['privilegios']; ?> - </span>

                    <?php
                      }
                    } catch (PDOException $conteoPrivilegios) {
                      echo 'Error al contar datos : ' . $conteoPrivilegios->getMessage();
                    }

                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </main>
  <?php
  include('../panel_admin/Formu-Agregar-Agenda.php');
  include('../panel_admin/Formu-Agregar-Contactos.php');
  ?>
  <!--   Core JS Files   -->
  <script src="../front-end/js/jquery-3.6.0.min.js"></script>
  <script src="../front-end/js/core/popper.min.js"></script>
  <script src="../front-end/js/core/bootstrap.min.js"></script>
  <script src="../front-end/js/jquery.dataTables.min.js"></script>
  <script src="../front-end/custom.js"></script>
  <script src="../front-end/preloader-custom.js"></script>
  <script src="../front-end/datables_custom.js"></script>
</body>

</html>