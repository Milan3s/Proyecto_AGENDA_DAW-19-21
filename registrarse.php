<?php 
 session_start();
 require_once 'back_end/conexion_de_bbdd/config_bd.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registrarse</title>
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
</head>

<body class="sign-in-basic">
  <!-- Navbar Transparent -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
    <div class="container">
      <img src="front-end/logos/LogoAgenda.png" alt="">
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
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 titulo-de-form">Formulario de Registro</h4>
              </div>
            </div>
            <p class="text-center">
              <?php
              if (isset($_POST['btn_registrar'])) {
                $nombre = htmlspecialchars($_POST['nombre']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                

                $rol = $_POST['id_rol'];

                if (empty($nombre)) {
                  $errorMsg[] = "Ingrese nombre de usuario";
                } else if (empty($email)) {
                  $errorMsg[] = "Ingrese email";
                  //Valida que el email sea correcto
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $errorMsg[] = "Ingrese email valido";
                } else if (empty($password)) {
                  $errorMsg[] = "Ingrese password";
                } else if (strlen($password) < 3) {
                  $errorMsg[] = "Password minimo 3 caracteres";
                } else {
                  try {
                    $select_stmt = $bd->prepare("SELECT nombre,email FROM usuarios WHERE nombre = :unombre OR email = :uemail");
                    $select_stmt->bindValue(":unombre", $nombre, PDO::PARAM_STR);
                    $select_stmt->bindValue(":uemail", $email, PDO::PARAM_STR);
                    $select_stmt->execute();
                    //Descomentar para depurar codigo
                    // $select_stmt->debugDumpParams();

                    while ($comparar_campos = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                      if ($comparar_campos['nombre'] == $nombre && $comparar_campos['email'] == $email) {
                        $errorMsg[] = "Este usuario ya existe";
                      }
                    }

                    if (!isset($errorMsg)) {
                      $insert_stmt = $bd->prepare("INSERT INTO usuarios (id_rol,nombre,email,password) VALUES(:uid_rol,:unombre,:uemail,:upassword)");
                      $insert_stmt->bindParam(":uid_rol", $rol, PDO::PARAM_INT);
                      $insert_stmt->bindParam(":unombre", $nombre, PDO::PARAM_STR);
                      $insert_stmt->bindParam(":uemail", $email, PDO::PARAM_STR);
                      $insert_stmt->bindParam(":upassword", $password,PDO::PARAM_STR);

                      // depurar la consulta y parametros
                      // $insert_stmt->debugDumpParams();
                      // var_dump($insert_stmt);

                      if ($insert_stmt->execute()) {
                        $registerMsg = "Registro se ha realizado con éxito: Tu estado ahora mismo está a la espera de ser aprobado por el administrador.";
                        header("refresh:2; index.php");
                      }
                      
                    }
                  } catch (PDOException $err_registrarusuario) {
                    echo "Error al registrar el usuario : " . $err_registrarusuario->getMessage();
                    echo "Error en la linea  : " . $err_registrarusuario->getLine();
                  }
                }
              }

              ?>
            </p>
            <div class="card-body">
              <form role="form" class="text-start" method="POST">
                <div class="input-group input-group-dynamic mb-4 my-3">
                  <i class="fa fa-user form-icons-acceder" aria-hidden="true"></i>
                  <input type="text" name="nombre" class="form-control inputs-tipo-letra" placeholder="Nombre">
                </div>

                <div class="input-group input-group-dynamic mb-4 my-3">
                  <i class="far fa-envelope form-icons-acceder"></i>
                  <input type="email" name="email" class="form-control inputs-tipo-letra" placeholder="Correo">
                </div>


                <div class="input-group input-group-dynamic mb-4 my-3">
                  <i class="fa fa-key form-icons-acceder" aria-hidden="true"></i>
                  <input type="password" name="password" class="form-control inputs-tipo-letra" placeholder="Contraseña">
                </div>

                <input type="hidden" name="id_rol" value="4">

                <div class="text-center">
                  <input class="w-100 btn btn-lg btn-secondary" type="submit" name="btn_registrar" value="Registrarse">
                </div>
                <p class="mt-4 text-sm text-center texto-normal">
                  Tienes cuenta ?
                  <a href="acceder.php" class="text-success text-gradient font-weight-bold texto-normal">Accede !!!</a>
                </p>
              </form>
              
              <hr>
              <?php
              if ($bd == true) {
                echo "<p class='text-center estado-de-la-conexion'>
                            Aplicación conectada. <i class='fa fa-check-circle text-success' aria-hidden='true'></i>
                          </p>";
              }
              ?>

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
                if (isset($registerMsg)) {
                  ?>
                  <div class="alert alert-success">
                    <strong class="text-dark"><?php echo $registerMsg; ?></strong>
                  </div>
                <?php
                }
                ?>
              </small>
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
                <a href="#portfolio" class="nav-link text-white" target="_blank">PortFolio</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="front-end/js/core/popper.min.js" type="text/javascript"></script>
  <script src="front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="front-end/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="front-end/js/plugins/parallax.min.js"></script>
  <script src="front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>

</body>

</html>