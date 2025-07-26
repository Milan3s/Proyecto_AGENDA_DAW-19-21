<?php
/*Este es el archivo donde el usuario va redirigido, si no inicia sesión y lo pega en otro navegador o intenta acceder a la aplicación 
  Sin estar autenticado en ella.
*/
session_start(); // Inicia la sesión.
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../front-end/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../front-end/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="../front-end/custom.css">
    <title>Area Restringida</title>
</head>

<body class="body-proyecto">
     <!-- Navbar Transparent -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent"><!-- Inicio nav -->
    <div class="container"><!-- Inicio container -->
      <a class="navbar-brand text-white">
        <img src="../front-end/logos/LogoAgenda.png" alt=""> <!-- logotipo para la aplicación -->
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"> <!-- Este button es para la sección responsive -->
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
        <ul class="navbar-nav navbar-nav-hover ms-auto">
          <li class="nav-item ms-lg-auto">
            <a class="nav-link nav-link-icon me-2" href="../index.php"><!-- Este enlace lleva al formulario de acceso  -->
              <i class="fa fa-user-circle-o me-1"></i>
              <p class="d-inline text-sm z-index-1 font-weight-bold">Acceder</p>
            </a>
          </li>
          <li class="nav-item ms-lg-auto">
            <a class="nav-link nav-link-icon me-2" href="../registrarse.php"><!-- Este enlace lleva al formulario de registro -->
              <i class="fa fa-user-plus me-1"></i>
              <p class="d-inline text-sm z-index-1 font-weight-bold">Registrarse</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav><!-- fin nav -->
    <div class="container"> <!-- Inicio container -->
        <div class="row"><!-- Inicio row -->
            <div class="col-12 mx-auto col-lg-12"><!-- Inicio col -->
                <div class="row justify-content-center my-5"><!-- Inicio row -->
                    <div class="mover-area-restringida">
                        <h1 class="my-5 text-center panel-admin">Área Restringida</h1>
                        <div class="col-sm-4 my-3 mx-auto">
                            <p class="col-sm-12 text-center text-white">OoOps ! parece que no se ha autenticado primero.</p>
                            <div class="text-center my-5">
                                <a href="../index.php" class="btn btn-warning"> <!-- Este enlace lleva al formulario de acceso  -->
                                    Acceder
                                </a>
                                <a href="../registrarse.php" class="btn btn-warning"><!-- Este enlace lleva al formulario de registro -->
                                    Registrarse
                                </a>
                            </div>
                          </div>
                      </div>
                  </div><!-- fin row -->
             </div><!-- fin col -->
          </div><!-- fin row -->
    </div><!-- fin container -->
  
                                  
    <footer id="bajar-footer-forms-registro"><!-- Inicio footer -->
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-12 col-md-12 my-auto">
                    <div class="copyright text-center text-sm text-dark">
                        © <script>
                            document.write(new Date().getFullYear()) //metodo de javascript para conseguir la hora actual y la muestre por pantalla.
                        </script>,
                        Desarrollado por <i class="fa fa-heart" aria-hidden="true"></i> by
                        <a href="#" class="font-weight-bold text-dark" target="_blank">Milanés</a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- fin footer -->




    <!--   Core JS Files   -->
    <script src="../front-end/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../front-end/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="../front-end/js/plugins/perfect-scrollbar.min.js"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="../front-end/js/plugins/parallax.min.js"></script>
    <script src="../front-end/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>

</body>

</html>