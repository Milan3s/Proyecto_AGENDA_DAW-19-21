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
    <title>Panel Colaborador</title>
    <link rel="stylesheet" href="../front-end/font_awesome/css/font-awesome.css">
    <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="../front-end/dataTables/css/dataTables.material.css">
    <link rel="stylesheet" href="../front-end/custom.css">
</head>

<body class="body-proyecto">
<div class="loader">
    <span class="personalizar-cargando">Cargando página...</span><img class="thumb" src="../front-end/logos/loader_v1.gif" />
  </div>
    <div class="container">
        <div class="col-12 mx-auto col-lg-12">
            <div class="row justify-content-center empujar-pie-admin">
                <h1 class="my-5 text-center titulo-colaborador ">
                    Panel de Usuario Normal
                </h1>


                <div class="col-sm-4 my-4 mx-auto">
                    <div class="card h-200 fondo-para-las-targetas">
                        <div class="card-body">
                            <h5 class="card-title text-center my-4 titulo-cards">Contactos</h5>
                        </div>
                        <i class="fa fa-address-book mx-auto iconos-cartas" aria-hidden="true"></i>
                        <a href="contactos.php" class="btn btn-info my-5 mx-auto">
                            Contactos
                        </a>
                    </div>
                </div>

                <div class="col-sm-4 my-4 mx-auto">
                    <div class="card h-200 fondo-para-las-targetas">
                        <div class="card-body">
                            <h5 class="card-title text-center my-4 titulo-cards">Agenda</h5>
                        </div>
                        <i class="fa fa-mobile mx-auto iconos-cartas" aria-hidden="true"></i>

                        <a href="agenda.php" class="btn btn-info my-5 mx-auto">
                            Agenda
                        </a>
                    </div>
                </div>

                <div class="col-sm-4 my-4 mx-auto">
                    <div class="card h-200 fondo-para-las-targetas">
                        <div class="card-body">
                            <h5 class="card-title text-center my-4 titulo-cards">Eventos</h5>
                        </div>
                        <i class="fa fa-calendar mx-auto iconos-cartas" aria-hidden="true"></i>
                        <a href="eventos.php" class="btn btn-info my-5 mx-auto">
                            Eventos
                        </a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
            <div class="col-sm-4 my-4">
                    <div class="card h-200 fondo-para-las-targetas">
                        <div class="card-body">
                            <h5 class="card-title text-center my-4 titulo-cards"><?php echo $_SESSION["usuario"]; ?></h5>
                        </div>
                        <i class="mx-auto iconos-cartas">
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
                                    <li class="nav-item d-flex align-items-center">
                                        <div class="text-center">
                                            <img style="width:60px;" src="../subida_de_archivos/<?php echo $fila_foto['foto_usuarios']; ?>">

                                        </div>

                                    </li>
                            <?php
                                }
                            } catch (PDOException $sacarFoto) {
                                echo "algo ha ido mal" . $sacarFoto->getMessage();
                            }
                            ?>

                        </i>

                        <a href="perfil.php" class="btn btn-info enlaces-card-admin my-5 mx-auto">
                            Perfil
                        </a>
                    </div>
                </div>


                <div class="col-sm-4 my-4">
                    <div class="card h-200 fondo-para-las-targetas">
                        <div class="card-body">
                            <h5 class="card-title text-center my-4 titulo-cards">Salida</h5>
                        </div>
                        <i class="fa fa-sign-out mx-auto salir" aria-hidden="true"></i>
                        <a href="../back_end/cerrar_sesion/logout.php" class="btn btn-info my-5 mx-auto">
                           Salir
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="../front-end/js/core/popper.min.js" type="text/javascript"></script>
        <script src="../front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
        <script src="../front-end/js/plugins/perfect-scrollbar.min.js"></script>
        <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
        <script src="../front-end/js/plugins/parallax.min.js"></script>
        <script src="../front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>
        <script src="../front-end/preloader-custom.js"></script>
</body>
</html>