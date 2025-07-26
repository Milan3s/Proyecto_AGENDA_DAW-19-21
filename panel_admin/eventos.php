<?php
session_start();
require_once '../back_end/conexion_de_bbdd/config_bd.php';
if (!isset($_SESSION["usuario"])) {
    header("Location: ../area_no_permitida/restringida.php");
}



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
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-dashboard.css" rel="stylesheet" />
    <!-- FullCalendar -->
    <link rel="stylesheet" href="../front-end/fullcalendar/css/fullcalendar.css">
    <link rel="stylesheet" href="../front-end/custom.css">
</head>

<body style="background-color: #397f9b;">
<div class="loader">
    <span class="personalizar-cargando">Cargando página...</span><img class="thumb" src="../front-end/logos/loader_v1.gif" />
  </div>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark menu-aside" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
                <img src="../front-end/logos/LogoAgenda.png" style="width: 34px;" alt="">
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
                    <a class="nav-link text-white" href="inicio.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-database" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tablero</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="inicio.php">
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
                    <a class="nav-link text-white  active" href="eventos.php">
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
                    <a class="nav-link text-white " href="../back_end/cerrar_sesion/logout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl bg-blue py-3 fixed-top mover-admin-menu menu-todos" id="color-texto" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Estás en </a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Eventos</li>
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
                                echo "Algo ha salió mal" . $sacarFoto->getMessage();
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar-admin" class="col-centered"></div>
            </div>
        </div>

        <div class="modal fade my-5" id="ModalAgregar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content fondo-agregar">
                    <div class="modal-header">
                        <h5 class="modal-title titulo-modal-agregar">Añadir Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="POST" action="../back_end/procesos/agregarEvento.php">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-info form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="title" id="title" class="form-control custom-modal-agregar" placeholder="Titulo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-info form-icons-modales" aria-hidden="true"> Color: </i>
                                            <input type="color" name="color" id="color" class="custom-form custom-modal-agregar">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="start" class="form-control custom-modal-agregar" id="start" placeholder="Fecha Inicial">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="end" class="form-control custom-modal-agregar" id="end" placeholder="Fecha Inicial">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-user-circle form-icons-user" aria-hidden="true"></i>

                                            <select name="id_usuarios" class="select-usuario-c">
                                                <option value="" selected="selected">Selecciona un usuario</option>
                                                <?php
                                                $query_usuarios = $bd->query("SELECT * FROM usuarios");
                                                $usuarios = $query_usuarios->fetchAll();

                                                foreach ($usuarios as $fila_usuarios) {
                                                ?>
                                                    <option value="<?= $fila_usuarios["id_usuarios"] ?>">
                                                        <?= $fila_usuarios["nombre"] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                        <i class="fa fa-text-height form-icons-modales" aria-hidden="true"></i>
                                        <textarea type="text" name="description" id="description" placeholder="Descripción..." class="form-control custom-modal-agregar"></textarea>
                                    </div>
                                </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade my-5" id="ModalEditar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content fondo-agregar">
                    <div class="modal-header">
                        <h5 class="modal-title titulo-modal-agregar">Editar Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="POST" action="../back_end/procesos/editarEvento.php">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-info form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="title" id="title" class="form-control custom-modal-agregar" placeholder="Titulo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-info form-icons-modales" aria-hidden="true"> Color: </i>
                                            <input type="color" name="color" id="color" class="custom-form custom-modal-agregar">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="start" id="start" class="form-control custom-modal-agregar" placeholder="Fecha Inicial">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                            <input type="text" name="end" id="end" class="form-control custom-modal-agregar" placeholder="Fecha Final">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <i class="fa fa-user-circle form-icons-user" aria-hidden="true"></i>
                                            <select name="cambiar_usuarios" class="select-usuario-c">
                                                <option value="" selected="selected">Selecciona un usuario</option>
                                                <?php
                                                $query_usuarios = $bd->query("SELECT * FROM usuarios");
                                                $usuarios = $query_usuarios->fetchAll();

                                                foreach ($usuarios as $fila_usuarios) {
                                                ?>
                                                    <option value="<?= $fila_usuarios["id_usuarios"] ?>" <?php {
                                                                                                                echo ' selected="selected"';
                                                                                                            } ?>>
                                                        <?= $fila_usuarios["nombre"] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                            <div class="form-check">
                                                <label class="form-check-label custom-modal-eventos">
                                                    <input class="form-check-input " type="checkbox" name="borrar_eventos">
                                                    Borrar Evento
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                        <i class="fa fa-text-height form-icons-modales" aria-hidden="true"></i>
                                        <textarea type="text" name="description" id="description" placeholder="Descripción..." class="form-control custom-modal-agregar"></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" class="form-control" id="id">
                        <input type="hidden" name="id_usuarios" id="id_usuarios">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Evento</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../front-end/fullcalendar/js/jquery.js"></script>
    <script src="../front-end/js/core/bootstrap.min.js"></script>
    <script src="../front-end/fullcalendar/js/moment.min.js"></script>
    <script src="../front-end/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="../front-end/fullcalendar/lib/es.js"></script>

    <script>
        $(document).ready(function() {

            $('#calendar-admin').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
                select: function(start, end) {

                    $('#ModalAgregar #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAgregar #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAgregar').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEditar #id').val(event.id);
                        $('#ModalEditar #id_usuarios').val(event.id_usuarios);
                        $('#ModalEditar #title').val(event.title);
                        $('#ModalEditar #color').val(event.color);
                        $('#ModalEditar #start').val((event.start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalEditar #end').val((event.end));
                        if (event.end == true) {
                            $('#ModalEditar #end').val((event.end).format('YYYY-MM-DD HH:mm:ss'));
                        }
                        $('#ModalEditar #description').val(event.description);
                        $('#ModalEditar').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) {

                    edit(event);

                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

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
                            id_usuarios: '<?php echo $event['id_usuarios']; ?>',
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            color: '<?php echo $event['color']; ?>',
                            description: '<?php echo $event['description']; ?>'
                        },
                    <?php endforeach; ?>
                ]
            });

            function edit(event) {
                // console.log(event)
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');

                } else {
                    end = start;
                }

                id = event.id;
                id_usuarios = event.id_usuarios;

                Event = [];

                Event[0] = id;
                Event[1] = start;
                Event[2] = end;
                Event[3] = id_usuarios;




                $.ajax({
                    url: '../back_end/procesos/editarEventosFecha.php',
                    type: "POST",
                    data: {
                        Event: Event
                    },

                    success: function(rep) {
                        if (rep == 'OK') {
                            alert('Algo ha fallado !!');

                        } else {
                            alert('Se ha guardado !!');
                        }
                    }

                });

            }

        });
    </script>
    <script src="../front-end/preloader-custom.js"></script>
</body>

</html>