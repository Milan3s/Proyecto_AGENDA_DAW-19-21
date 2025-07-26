<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../area_no_permitida/restringida.php");
}

require_once '../back_end/conexion_de_bbdd/config_bd.php';

$sql = "SELECT id, id_usuarios, title, start, end, color,description FROM eventos ";

$req = $bd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../front-end/font_awesome/css/font-awesome.css">
    <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-dashboard.css" rel="stylesheet" />
    <!-- FullCalendar -->
    <link rel="stylesheet" href="../front-end/fullcalendar/css/fullcalendar.css">
    <link rel="stylesheet" href="../front-end/custom.css" media="screen">
</head>

<body class="body-proyecto">
    <div class="loader">
        <span class="personalizar-cargando">Cargando página...</span><img class="thumb" src="../front-end/logos/loader_v1.gif" />
    </div>
    <nav class="navbar navbar-expand-lg bg-blue py-3" id="color-texto">
        <div class="container">
            <a class="navbar-brand text-white" href="https://demos.creative-tim.com/material-kit/presentation" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                <img class="logos" src="../front-end/logos/LogoAgenda.png">
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
                            Eventos
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
                            <!-- bloque responsive -->
                            <div class="d-lg-none">
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
                                    <i class="fas fa-sign-out-alt"></i>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center todos-cal">
                <div id="calendar" class="col-centered"></div>
            </div>
        </div>

        <div class="modal fade my-5" id="ModalEditar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content fondo-agregar">
                    <div class="modal-header">
                        <h5 class="modal-title titulo-modal-agregar">Añadir Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                        <i class="fa fa-info form-icons-modales" aria-hidden="true"></i>
                                        <input type="text" id="title" class="form-control custom-modal-agregar" placeholder="Titulo">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-text-height form-icons-modales" aria-hidden="true"></i>
                                    <textarea type="text" id="description" placeholder="Descripción..." class="form-control custom-modal-agregar"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container -->
    <!-- jQuery Version 1.11.1 -->
    <script src="../front-end/fullcalendar/js/jquery.js"></script>
    <script src="../front-end/js/core/bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../front-end/fullcalendar/js/bootstrap.min.js"></script>
    <!-- FullCalendar -->

    <script src="../front-end/fullcalendar/js/moment.min.js"></script>
    <script src="../front-end/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="../front-end/fullcalendar/lib/es.js"></script>

    <script>
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,

                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEditar #id').val(event.id);
                        $('#ModalEditar #id_usuarios').val(event.id_usuarios);
                        $('#ModalEditar #title').val(event.title);

                        $('#ModalEditar #description').val(event.description);
                        $('#ModalEditar').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) { 

                    edit(event);

                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) {

                    edit(event);

                },
                events: [
                    <?php foreach ($events as $event) :

                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if ($start[1] == '00:00:00') {
                            $start = $start[0];
                        } else {
                            $start = $event['start'];
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event['end'];
                        }
                    ?> {
                            id: '<?php echo $event['id']; ?>',
                            id_usuarios: '<?php echo $event['id_usuarios'] ?>',
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            description: '<?php echo $event['description'] ?>',
                        },
                    <?php endforeach; ?>
                ]
            });
        });
    </script>
    <script src="../front-end/preloader-custom.js"></script>

</body>

</html>