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
    <title>Usuarios y Roles</title>
    <link rel="stylesheet" href="../front-end/font_awesome/css/font-awesome.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="../front-end/dataTables/css/dataTables.material.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="../front-end/custom.css">
</head>

<body class="body-proyecto">
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
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
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
                    <a class="nav-link text-white" href="agenda-y-contactos.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Agenda y Contactos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="usuarios-y-roles.php">
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
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl bg-blue py-3 fixed-top mover-admin-menu menu-todos" id="color-texto" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Estás en </a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Usuario y Roles</li>
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
                                } catch (PDOException $err_sacarFoto) {
                                    echo "No se pudo sacar el dato : " . $err_sacarFoto->getMessage();
                                    echo "Error en la linea : " . $err_sacarFoto->getLine();
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
        <!-- End Navbar -->
        <div class="anchura-admin">
            <div class="row">
                <div class="col-12">
                    <!-- Sección contactos -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-12 mx-auto col-lg-12">
                                    <div class="row justify-content-center">
                                        <div class="row">
                                            <div class="col-12 my-5">
                                                <div class="card my-4">
                                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                        <div class="bg-gradient-info shadow-info border-radius-lg pt-1">
                                                            <div class="centrar-agregar">
                                                                <h5 class="titulo-admin">Usuarios y Roles</h5>
                                                                <div class="centrar-boton-agregarContactos">
                                                                    <button class="btn btn-icon btn-2 btn-success boton-agregar" data-bs-toggle="modal" data-bs-target="#AgregarNuevoUsuario">
                                                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-4 pb-2">
                                                        <div class="table-responsive p-0">
                                                            <table class="table align-items-center justify-content-center mb-0 display" id="tabla_usuarios_y_roles">
                                                                <thead class="alinear_tabla">
                                                                    <th>#</th>
                                                                    <th>Descripción</th>
                                                                    <th>Foto</th>
                                                                    <th>Nombre</th>
                                                                    <th>Apellidos</th>
                                                                    <th>Email</th>
                                                                    <th>Contraseña</th>
                                                                    <th>Fijo</th>
                                                                    <th>Móvil</th>
                                                                    <th>Dirección</th>
                                                                    <th>Rol</th>
                                                                    <th>Acción</th>
                                                                </thead>
                                                                <tbody class="alinear_tabla">
                                                                    <div class="text-center">
                                                                        <?php
                                                                        if (isset($_SESSION['message_usuario'])) {
                                                                        ?>
                                                                            <div class="alert alert-success text-center" style="margin-top:20px;">
                                                                                <?php echo $_SESSION['message_usuario']; ?>
                                                                            </div>
                                                                        <?php
                                                                            unset($_SESSION['message_usuario']);
                                                                            unset($_SESSION['message_linea']);
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                    //requerimos el fichero de conexion

                                                                    $query_roles = $bd->query("SELECT usuarios.id_usuarios AS id_usuarios, usuarios.nombre,
                                                                    usuarios.apellidos AS apellidos,usuarios.email AS email,usuarios.password AS password,usuarios.descripcion AS descripcion,
                                                                    usuarios.fijo AS fijo, usuarios.movil AS movil, usuarios.foto_usuarios AS foto_usuarios,
                                                                    usuarios.direccion AS direccion, rol.privilegios AS privilegios 
                                                                    FROM `usuarios` AS usuarios INNER JOIN rol AS rol ON rol.id_rol = usuarios.id_rol;  ");
                                                                    $usuarios = $query_roles->fetchAll(PDO::FETCH_ASSOC);

                                                                    try {
                                                                        foreach ($usuarios as $fila_usuarios) {
                                                                    ?>
                                                                            <tr>
                                                                                <td><?php echo $fila_usuarios['id_usuarios']; ?></td>
                                                                                <td><?php echo $fila_usuarios['descripcion']; ?></td>
                                                                                <td>
                                                                                    <img class="foto_contacto" src="../subida_de_archivos/<?php echo $fila_usuarios['foto_usuarios']; ?>">
                                                                                </td>
                                                                                <td><?php echo $fila_usuarios['nombre']; ?></td>
                                                                                <td><?php echo $fila_usuarios['apellidos']; ?></td>
                                                                                <td><?php echo $fila_usuarios['email']; ?></td>
                                                                                <td><?php echo $fila_usuarios['password']; ?></td>
                                                                                <td><?php echo $fila_usuarios['fijo']; ?></td>
                                                                                <td><?php echo $fila_usuarios['movil']; ?></td>
                                                                                <td><?php echo $fila_usuarios['direccion']; ?></td>
                                                                                <td><?php echo $fila_usuarios['privilegios']; ?></td>
                                                                                <td>
                                                                                    <span class="my-3 mover-acciones text-info" data-bs-toggle="modal" data-bs-target="#editar_usuarios<?php echo $fila_usuarios['id_usuarios']; ?>"><i class="fa fa-pencil cursor" aria-hidden="true"></i></span>
                                                                                    <span class="my-3 mover-acciones text-danger" class="btn-danger my-3" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#id_borrar_usuarios<?php echo $fila_usuarios['id_usuarios']; ?>"><i class="fa fa-trash cursor" aria-hidden="true"></i></span>
                                                                                </td>
                                                                                <?php include('../panel_admin/Formu-BorrarEditar-Usuario.php'); ?>
                                                                            </tr>
                                                                    <?php
                                                                        }
                                                                    } catch (PDOException $err_filausuarios) {
                                                                        echo "No se encontraron datos : " . $err_filausuarios->getMessage();
                                                                        echo "Error en la linea : ".$err_filausuarios->getLine();
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
                </div>
            </div>
        </div>
    </main>
    <?php include('../panel_admin/Formu-Agregar-Usuario.php'); ?>

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