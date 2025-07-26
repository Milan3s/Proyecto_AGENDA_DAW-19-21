<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acceder</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="front-end/css/nucleo-icons.css" rel="stylesheet" />
  <link href="front-end/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
  <link rel="stylesheet" href="front-end/custom.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
</head>


<body class="sign-in-basic">
  <!-- Navbar Transparent -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
    <div class="container">
      <a class="navbar-brand text-white">
        <img src="front-end/logos/LogoAgenda.png" alt="">
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
        <ul class="navbar-nav navbar-nav-hover ms-auto">
          <li class="nav-item ms-lg-auto">
            <a class="nav-link nav-link-icon me-2" href="index.php">
              <i class="fa fa-user-circle-o me-1"></i>
              <p class="d-inline text-sm z-index-1 font-weight-bold">Acceder</p>
            </a>
          </li>
          <li class="nav-item ms-lg-auto">
            <a class="nav-link nav-link-icon me-2" href="registrarse.php">
              <i class="fa fa-user-plus me-1"></i>
              <p class="d-inline text-sm z-index-1 font-weight-bold">Registrarse</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header align-items-start min-vh-100" style="background-image: url('front-end/img/fondo-formularios.jpg');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card fondo-login z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="fondo-del-titulo shadow-acceder border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 titulo-de-form">Formulario de Acceso</h4>
              </div>
            </div>
            <p class="text-center">
              <?php
              //Requiero la conexión a la base de datos
              require_once 'back_end/conexion_de_bbdd/config_bd.php';
              /*
                Almaceno en sesion los paneles a los que quiero que redirija cuando el usuario se loguee
                Con Location : -> redirijo al usuario
              */
              if (isset($_SESSION["admin_login"])) {
                header("Location: panel_admin/inicio.php");
              }
              if (isset($_SESSION["colaborador_login"])) {
                header("Location: panel_colaborador/inicio.php");
              }
              if (isset($_SESSION["normal_login"])) {
                header("Location: panel/usuario.php");
              }
              //Declaro las variables vacías
              $nombre = '';
              $password = '';
              $rol = '';

              if (isset($_POST['btn_login'])) {
                $nombre = htmlspecialchars($_POST["nombre"]);
                $password = htmlspecialchars($_POST["password"]);
                $rol = htmlspecialchars($_POST["id_rol"]);
                $_SESSION["usuario"] = $_POST["nombre"];

                /*En esta condición compruebo si el nombre está vacío que lo requiera y lo introduzca en las demás es la misma comprobación */
                if (empty($nombre)) {
                  $errorMsg[] = "Por favor ingrese Nombre"; //Revisar email
                } else if (empty($password)) {
                  $errorMsg[] = "Por favor ingrese Password"; //Revisar password vacio
                } else if (empty($rol)) {
                  $errorMsg[] = "Por favor seleccione Rol "; //Revisar rol vacio
                  //Vuelvo a comprobar si el nombre el password y el rol existen en base de datos
                } else if ($nombre and $password and $rol) {
                  try {
                    /*
                      Esta consulta comprueba si el usuario existe en la tabla usuarios
                    */

                    $select_stmt = $bd->prepare("SELECT * FROM usuarios WHERE id_rol=:urol AND nombre=:unombre AND password=:upassword");
                    $select_stmt->bindParam(":unombre", $nombre, PDO::PARAM_STR);
                    $select_stmt->bindParam(":upassword", $password,PDO::PARAM_STR);
                    $select_stmt->bindParam(":urol", $rol, PDO::PARAM_INT);
                    $select_stmt->execute();

                    while ($fila_usuarios = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                      $bdnombre = $fila_usuarios["nombre"];
                      $bdpassword = $fila_usuarios["password"];
                      $bdrol = $fila_usuarios["id_rol"];
                    }


                    //Descomentar en caso de error
                    // $select_stmt->debugDumpParams();
                    // var_dump($fila_usuarios);

                    if ($nombre != null & $password  != null & $rol != null) {
                      if ($select_stmt->rowCount() > 0) {
                        if ($nombre == $bdnombre & $password == $bdpassword &  $rol == $bdrol) {
                           
                          switch ($bdrol) {
                            //  El caso 1 es el administrador
                            case "1":
                              $_SESSION["admin_login"] = $nombre;
                              $_SESSION["admin_login"] = $rol;

                              $loginMsg = "Inicio sesión con éxito";
                              header("refresh:3; panel_admin/inicio.php");
                              break;
                              //  El caso 2 es el colaborador
                            case "2";
                              $_SESSION["colaborador_login"] = $nombre;
                              $_SESSION["colaborador_login"] = $rol;
                              $loginMsg = "Inicio sesión con éxito";
                              header("refresh:3; panel_colaborador/inicio.php");
                              break;
                              //  El caso 3 es el usuario normal
                            case "3":
                              $_SESSION["normal_login"] = $nombre;
                              $_SESSION["normal_login"] = $rol;
                              $loginMsg = "Inicio sesión con éxito";
                              header("refresh:3; panel_usuario/inicio.php");
                              break;

                            default:
                              $errorMsg[] = "El usuario no existe en la aplicación.";
                          }
                        } else {
                          $errorMsg[] = "El usuario no existe en la aplicación.";
                        }
                      } else {
                        $errorMsg[] = "El usuario no existe en la aplicación.";
                      }
                    } else {
                      $errorMsg[] = "El usuario no existe en la aplicación.";
                    }
                  } catch (PDOException $err_acceso) {
                    echo "Error : ".$err_acceso->getMessage();
                    echo "Linea : ".$err_acceso->getLine();
                  }
                } else {
                  $errorMsg[] = "El nombre o contraseña o rol incorrectos";
                }
              }
              ?>
              <!-- root 	root 	root@gmail.com 	root 	el root de la app 	968-00-00-00 	698-00-00-00 	2.png 	Murcia -->
            <div class="card-body">
              <form role="form" class="text-start" method="POST">
                <div class="input-group input-group-dynamic mb-4 my-3">
                  <i class="fa fa-user form-icons-acceder" aria-hidden="true"></i>
                  <input type="text" name="nombre" class="form-control inputs-tipo-letra" placeholder="Nombre..." value="<?php if (isset($nombre)) echo $nombre ?>">
                </div>

                <div class="input-group input-group-dynamic mb-4 my-3">
                  <i class="fa fa-key form-icons-acceder" aria-hidden="true"></i>
                  <input type="password" name="password" class="form-control inputs-tipo-letra" placeholder="Contraseña" value="<?php if (isset($password)) echo $password ?>">
                </div>
                <div class="col-sm-12">

                  <div class="input-group input-group-dynamic input-group-custom">
                    <i class="fa fa-cog form-icons-acceder" aria-hidden="true"></i>
                    <select name="id_rol" id="id_rol" class="form-select form-select-custom-acceder">
                      <option>Selecciona un rol</option>
                      <?php
                      $query_rol = $bd->query("SELECT id_rol,privilegios FROM rol AS rol WHERE rol.privilegios = 'Administrador' OR rol.privilegios = 'Colaborador' OR rol.privilegios = 'Normal';");
                      $resultado_tipo_rol = $query_rol->fetchAll();

                      foreach ($resultado_tipo_rol as $roles) {
                      ?>
                        <option value="<?php echo $roles["id_rol"]; ?>" <?php if ($roles["id_rol"] == $rol) {
                                                                          echo 'selected="selected"';
                                                                        } ?>>
                          <?php echo $roles["privilegios"]; ?>
                        </option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="text-center">
                  <input class="w-100 btn btn-lg btn-secondary my-3" type="submit" name="btn_login" value="Iniciar Sesión" />
                </div>

                <p class="mt-4 text-sm text-center texto-normal">
                  No tienes cuenta ?
                  <a href="registrarse.php" class="text-success text-gradient font-weight-bold texto-normal">Registrate</a>
                </p>
                <hr>


                <small class="text-muted texto-para-verificar">
                  <?php
                  if (isset($errorMsg)) {
                    foreach ($errorMsg as $error) {
                  ?>
                      <div class="alert alert-danger">
                        <strong class="text-dark"><?php echo $error; ?></strong>
                      </div>
                    <?php
                    }
                  }
                  if (isset($loginMsg)) {
                    ?>
                    <div class="alert alert-success">
                      <strong class="text-dark"><?php echo $loginMsg; ?> </strong>
                    </div>
                  <?php
                  }
                  ?>
                </small>
                </p>
              </form>
              <?php
              //Compruebo que la conexión a base de datos es correcta
              if ($bd == true) {
                echo "<p class='text-center estado-de-la-conexion'>
                            Aplicación conectada. <i class='fa fa-check-circle text-success' aria-hidden='true'></i>
                      </p>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-white text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              Desarrollado por <i class="fa fa-heart" aria-hidden="true"></i> by
              <a href="#" class="font-weight-bold text-white" target="_blank">Milanés</a>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="#p" class="nav-link text-white" target="_blank">PortFolio</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <script src="front-end/js/core/popper.min.js" type="text/javascript"></script>
  <script src="front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="front-end/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="front-end/js/plugins/parallax.min.js"></script>
  <script src="front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>
</body>

</html>