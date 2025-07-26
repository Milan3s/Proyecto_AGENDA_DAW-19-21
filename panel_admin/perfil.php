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
    <title>Perfil</title>
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
            <a class="navbar-brand m-0" href="#a" target="_blank">
                <img class="logos" src="../front-end/logos/LogoAgenda.png" alt="">
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
                    <a class="nav-link text-white active" href="perfil.php">
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Perfil</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>

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

                    <ul class="navbar-nav  justify-content-end">
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
        <div class="container">
            <div class="col-md-12">
                <div class="text-center bajar-mensaje-de-session1">
                    <?php
                    if (isset($_SESSION['message_perfil'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['message_perfil']; ?>
                        </div>
                    <?php
                        unset($_SESSION['message_perfil']);
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mx-auto col-lg-12 my-4">
                    <div class="row justify-content-center my-4">
                        <?php
                        $nombreUsuario = $_SESSION["usuario"];

                        $detallesU = $bd->prepare("SELECT 
                        id_usuarios AS id_usuarios,
                        nombre AS nombre,
                        apellidos AS apellidos,
                        email AS email, 
                        descripcion AS descripcion,
                        fijo AS fijo,
                        movil AS movil,
                        direccion AS direccion,
                        foto_usuarios AS foto_usuarios
                        FROM usuarios as usuarios 
                        WHERE nombre = :nombre");
                        $detallesU->bindParam(":nombre", $nombreUsuario);
                        $detallesU->execute();

                        $mostrarDetalles = $detallesU->fetchAll(PDO::FETCH_ASSOC);
                        try {
                            foreach ($mostrarDetalles as $informacion) {
                        ?>
                                <div class="col-sm-4 my-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="../subida_de_archivos/<?php echo $informacion['foto_usuarios']; ?>" class="circular">
                                            </div>
                                            <p class="text-center descripcion-perfil-php my-3"><?php echo $informacion["descripcion"] ?></p>
                                            <hr>

                                            <div>
                                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#actualizarPerfil_<?php echo $informacion['id_usuarios']; ?>">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>

                                                <input type="hidden" name="id_usuarios" value="<?php echo $informacion["id_usuarios"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 my-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Nombre : </span> <span class="texto-php"> <?php echo $informacion["nombre"]; ?> </span>
                                            </div>

                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Apellidos : </span><span class="texto-php"><?php echo $informacion["apellidos"]; ?></span>
                                            </div>

                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Email : </span> <span class="texto-php"><?php echo $informacion["email"]; ?></span>
                                            </div>

                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Teléfono : </span> <span class="texto-php"><?php echo $informacion["fijo"] ?></span>
                                            </div>

                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Móvil : </span><span class="texto-php"><?php echo $informacion["movil"] ?></span>
                                            </div>

                                            <div class="input-group flex-nowrap my-3">
                                                <span class="texto-normal">Dirección : </span> <span class="texto-php"><?php echo $informacion["direccion"]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
            <?php
                            }
                        } catch (PDOException $detalles) {
                            echo "algo ha ido mal" . $detalles->getMessage();
                        }
            ?>
                </div>
            </div>
        </div>
        <div>
            <?php
            $passPerfil = $_SESSION["usuario"];
            $actualizarPassword = $bd->prepare("SELECT usuarios.id_usuarios AS id_usuarios,
            usuarios.password AS password
            FROM usuarios AS usuarios
            WHERE nombre = :nombre");
            $actualizarPassword->bindParam(":nombre", $passPerfil);
            $actualizarPassword->execute();
            $resultado_id = $actualizarPassword->fetchAll(PDO::FETCH_ASSOC);
            try {
                foreach ($resultado_id as $sacar_id) {
            ?>
        </div>
        <div class="form-password">
            <div class="card">
                <div class="card-body">
                    <form action="../back_end/procesos/actualizarPassword.php" method="POST">
                        <div class="input-group input-group-dynamic">
                            <span class="pass-new">Contraseña : </span><input type="password" name="password" placeholder="*********" class="form-control">
                        </div>
                        <div class="div-boton">
                            <button class="btn btn-info" type="submit" name="actualizar_pass">
                                Actualizar
                            </button>
                            <input type="hidden" name="id_usuarios" value="<?php echo $sacar_id['id_usuarios'] ?>">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center bajar-mensaje-de-session2">
                    <?php
                    if (isset($_SESSION['message_password'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['message_password']; ?>
                        </div>
                    <?php
                        unset($_SESSION['message_password']);
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
                }
            } catch (PDOException $id_usuarios) {
                echo "No ha salido el id_usuarios" . $id_usuarios->getMessage();
                echo "Linea de error : " . $id_usuarios->getLine();
            }
?>
</div>
    </main>
    <?php include '../panel_admin/Formu-Perfil.php'; ?>

    <!--   Core JS Files   -->
    <script src="../front-end/js/jquery-3.6.0.min.js"></script>
    <script src="../front-end/js/core/popper.min.js"></script>
    <script src="../front-end/js/core/bootstrap.min.js"></script>
    <script src="../front-end/js/jquery.dataTables.min.js"></script>
    <script src="../front-end/custom.js"></script>
    <script src="../front-end/preloader-custom.js"></script>
</body>

</html>