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
          <a class="nav-link text-white active" href="agenda-y-contactos.php">
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
          <a class="nav-link text-white " href="eventos.php">
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
  <!-- End Navbar -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl bg-blue py-3 fixed-top mover-admin-menu menu-todos" id="color-texto" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Estás en </a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Agenda y Contactos</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <?php
                //Aquí estoy sacando la foto y el nombre del usuario en sesión para que pueda verse cuando loguea.
                $foto_usuario = $_SESSION["usuario"];

                $foto_del_usuario = $bd->prepare("SELECT 
                        id_usuarios AS id_usuarios,
                        foto_usuarios AS foto_usuarios
                        FROM usuarios as usuarios 
                        WHERE nombre = :nombre");
                $foto_del_usuario->bindParam(":nombre", $foto_usuario);//le paso el parametro y la variable almacenada en sesion.
                $foto_del_usuario->execute();
                // Aquí hago una array asociativo para que pueda recorrer los campos de la tabla, es decir las columnas.
                $mostrarFoto = $foto_del_usuario->fetchAll(PDO::FETCH_ASSOC);
                try {
                   //consulta - columna 
                  foreach ($mostrarFoto as $fila_foto) {
                ?>
                    <ul class="navbar-nav  justify-content-end">
                      <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                          <div class="text-center">
                            <img style="width:40px;" src="../subida_de_archivos/<?php echo $fila_foto['foto_usuarios']; ?>"><!-- Saco la foto recorriendo la fila y almacenandola en el servidor -->
                          </div>
                          <span class="d-sm-inline d-none"><?php echo $_SESSION["usuario"]; ?></span><!-- Almaceno el nombre en sesión -->
                        </a>
                      </li>
                  <?php
                  }
                  //Capturo los errores de la consulta y los muestro por pantalla para ver que ha salido mal
                } catch (PDOException $sacarFoto) {
                  echo "Error al sacar los datos : " . $sacarFoto->getMessage();
                  echo "Error en la linea : " . $sacarFoto->getLine();
                }
                  ?>
                  <!--  -->
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

        <!-- Sección Agenda -->
        <div class="container">
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
                              <h5 class="titulo-admin">Crear Agenda</h5>
                              <div class="centrar-boton-agregarContactos">
                                <button class="btn btn-icon btn-2 btn-success boton-agregar" data-bs-toggle="modal" data-bs-target="#AgregarAgenda">
                                  <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                          <div class="alinear_tabla">
                            <!-- 
                              Este id lo llama en el fichero js custom que se ubica en la carpeta front_end -> custom.js 
                              Sirve para mostrar la información en dataTables por identificador.
                            -->
                            <table class="table align-items-center justify-content-center mb-0 display" id="tabla_agenda">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Versión</th>
                                <th>Foto</th>
                                <th>Acción</th>
                              </thead>
                              <tbody class="alinear_tabla_contactos">
                                <div class="text-center">
                                  <?php
                                  if (isset($_SESSION['message_agenda'])) {
                                  ?>
                                    <div class="alert alert-success text-center" style="margin-top:20px;">
                                      <?php echo $_SESSION['message_agenda']; ?>
                                    </div>


                                  <?php
                                    unset($_SESSION['message_agenda']);
                                  }
                                  ?>
                                </div>

                                <?php

                                try {

                                  $query_dispositivos = $bd->query("SELECT id_dispositivo AS id_dispositivo,
                                        nombre AS nombre,descripcion AS descripcion, version AS version,
                                        marca AS marca,foto_dispositivo as foto_dispositivo FROM dispositivo;");
                                        // Aquí hago una array asociativo para que pueda recorrer los campos de la tabla, es decir las columnas.
                                  $dispositivos = $query_dispositivos->fetchAll(PDO::FETCH_ASSOC);
                                            //consulta - columna 
                                  foreach ($dispositivos as $dispositivos_moviles) {
                                ?>
                                    <tr>
                                      <!-- Recorro todos los campos de la tabla contactos -->
                                      <td><?php echo $dispositivos_moviles['id_dispositivo']; ?></td>
                                      <td><?php echo $dispositivos_moviles['nombre']; ?></td>
                                      <td><?php echo $dispositivos_moviles['descripcion']; ?></td>
                                      <td><?php echo $dispositivos_moviles['version']; ?></td>
                                      <td><?php echo $dispositivos_moviles['marca']; ?></td>
                                       <!-- Aquí recorro el directoroio subida de ficheros para mostrar la imagen desde el sevidor -->
                                      <td><img class="img-foto-insertar-dispositivo" src="../subida_de_archivos/<?php echo $dispositivos_moviles['foto_dispositivo']; ?>" alt=""></td>
                                      <td>
                                        <!-- Estos botones llaman al modal internamente paraque aparezca en pantalla -->
                                        <span class="my-3 mover-acciones text-info" data-bs-toggle="modal" data-bs-target="#editar_dispositivo<?php echo $dispositivos_moviles['id_dispositivo']; ?>"><i class="fa fa-pencil cursor" aria-hidden="true"></i></span>
                                        <span class="my-3 mover-acciones text-danger" class="btn-danger my-3" data-bs-toggle="modal" data-bs-target="#borrar_dispositivo<?php echo $dispositivos_moviles['id_dispositivo']; ?>"><i class="fa fa-trash cursor" aria-hidden="true"></i></span>
                                      </td>
                                      <?php include('../panel_admin/Formu-BorrarEditar-Agenda.php'); ?>
                                      <!-- Incluimos el modal Borrar y Editar -->

                                    </tr>
                                <?php
                                  }
                                  //Capturo el error y muestro la linea que corresponde
                                } catch (PDOException $err_dispositivosmoviles) {
                                  echo "No se encontraron datos : " . $err_dispositivosmoviles->getMessage();
                                  echo "El error esta en la linea : " . $err_dispositivosmoviles->getLine();
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

        <!-- Sección contactos -->
        <div class="container">
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
                              <h5 class="titulo-admin">Crear Contactos</h5>
                              <div class="centrar-boton-agregarContactos">
                                <button class="btn btn-icon btn-2 btn-success boton-agregar" data-bs-toggle="modal" data-bs-target="#AgregarNuevoContacto">
                                  <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                          <div class="alinear_tabla">
                            <!-- 
                              Este id lo llama en el fichero js custom que se ubica en la carpeta front_end -> custom.js 
                              Sirve para mostrar la información en dataTables por identificador.
                            -->
                            <table class="table align-items-center justify-content-center mb-0 display" id="tabla_contactos">
                              <thead>

                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Cumpleaños</th>
                                <th>Dispositivo</th>
                                <th>Ciudad</th>
                                <th>País</th>
                                <th>Idioma</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Acción</th>
                              </thead>
                              <tbody class="alinear_tabla_contactos">
                                <div class="text-center">
                                  <?php


                                  if (isset($_SESSION['message_contacto'])) {
                                  ?>
                                    <div class="alert alert-success text-center" style="margin-top:20px;">
                                      <?php echo $_SESSION['message_contacto']; ?>
                                    </div>


                                  <?php
                                    unset($_SESSION['message_contacto']);
                                  }
                                  ?>
                                </div>

                                <?php

                                $query_contactos = $bd->query("SELECT 
                                    contactos.id_contactos AS id_contactos, 
                                    contactos.id_dispositivo AS id_dispositivo, 
                                    contactos.nombre AS nombre, 
                                    contactos.apellidos AS apellidos, 
                                    contactos.cumple AS cumple,
                                    dispositivos.nombre AS dispositivo, 
                                    contactos.ciudad AS ciudad,
                                    contactos.pais AS pais, 
                                    contactos.telefono AS telefono, 
                                    contactos.email AS email, 
                                    contactos.idioma AS idioma, 
                                    contactos.foto AS foto       
                                    FROM contactos AS contactos 
                                    INNER JOIN dispositivo AS dispositivos ON contactos.id_dispositivo =  dispositivos.id_dispositivo
                                    ORDER BY id_contactos;");
                                    // Aquí hago una array asociativo para que pueda recorrer los campos de la tabla, es decir las columnas.
                                $contactos = $query_contactos->fetchAll(PDO::FETCH_ASSOC);
                                try {
                                            //consulta - columna 
                                  foreach ($contactos as $fila_contactos) {
                                ?>
                                    <tr>
                                      <!-- Recorro todos los campos de la tabla contactos -->
                                      <td><?php echo $fila_contactos['id_contactos']; ?> </td>
                                      <td><?php echo $fila_contactos['nombre']; ?> </td>
                                      <td><?php echo $fila_contactos['apellidos']; ?> </td>
                                      <td><?php echo $fila_contactos['cumple']; ?> </td>
                                      <td><?php echo $fila_contactos['dispositivo']; ?> </td>
                                      <td><?php echo $fila_contactos['ciudad']; ?> </td>
                                      <td><?php echo $fila_contactos['pais']; ?> </td>
                                      <td>
                                        <!-- Aquí recorro el directoroio subida de ficheros para mostrar la imagen desde el sevidor -->
                                        <img class="foto_contacto" src="../subida_de_archivos/<?php echo $fila_contactos['idioma']; ?>">
                                      </td>


                                      <td><?php echo $fila_contactos['telefono']; ?> </td>
                                      <td><?php echo $fila_contactos['email']; ?> </td>
                                      <td>
                                        <!-- Aquí recorro el directoroio subida de ficheros para mostrar la imagen desde el sevidor -->
                                        <img class="foto_contacto" src="../subida_de_archivos/<?php echo $fila_contactos['foto']; ?>">
                                        
                                      </td>
                                      <td>
                                        <!-- Estos botones llaman al modal internamente paraque aparezca en pantalla -->
                                        <span class="my-3 mover-acciones text-info" data-bs-toggle="modal" 
                                        data-bs-target="#editar<?php echo $fila_contactos['id_contactos']; ?>"><i class="fa fa-pencil cursor" aria-hidden="true"></i></span>
                                        
                                        <span class="my-3 mover-acciones text-danger" class="btn-danger my-3" data-bs-toggle="modal" data-bs-target="#id<?php echo $fila_contactos['id_contactos']; ?>">
                                            <i class="fa fa-trash cursor" aria-hidden="true"></i></span>
                                      </td>
                                      <?php include('../panel_admin/Formu-BorrarEditar-Contactos.php'); ?>
                                    </tr>
                                <?php
                                  }
                                  //Capturo el error y muestro la linea que corresponde
                                } catch (PDOException $err_filacontactos) {
                                  echo "No se encontraron datos : " . $err_filacontactos->getMessage();
                                  echo "El error está en lalinea : " . $err_filacontactos->getLine();
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
  </main>
  <?php
  include('../panel_admin/Formu-Agregar-Agenda.php');// Inlcuye el formulario para agregar la agenda
  include('../panel_admin/Formu-Agregar-Contactos.php');// Incluye el formulario para agregar los contactos
  

  ?>
  <!--   Core JS Files   -->
  <script src="../front-end/js/jquery-3.6.0.min.js"></script>
  <script src="../front-end/js/core/popper.min.js"></script>
  <script src="../front-end/js/core/bootstrap.min.js"></script>
  <script src="../front-end/js/jquery.dataTables.min.js"></script>
  <script src="../front-end/preloader-custom.js"></script>
  <script src="../front-end/datables_custom.js"></script>
  <script src="../front-end/custom.js"></script>
  
</body>
