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
                            Perfil
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

    <!-- End Navbar -->
    <div class="container">
        <div class="text-center bajar-mensaje-de-session-unormal">
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
        <div class="row">
            <div class="col-12 mx-auto col-lg-12">
                <div class="row justify-content-center">
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
                                <div class="card my-4">
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

                            <div class="col-sm-7 my-3">
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
    <div class="form-password-unormal my-5">
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

<?php include '../panel_colaborador/Formu-Perfil.php'; ?>

<!--   Core JS Files   -->
<script src="../front-end/js/jquery-3.6.0.min.js"></script>
<script src="../front-end/js/core/popper.min.js" type="text/javascript"></script>
<script src="../front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="../front-end/js/plugins/parallax.min.js"></script>
<script src="../front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>
<script src="../front-end/custom.js"></script>
<script src="../front-end/preloader-custom.js"></script>


</body>

</html>