<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>

    <link rel="stylesheet" href="../../front-end/font_awesome/css/font-awesome.css">
    <link id="pagestyle" href="../../front-end/css/material-kit.css?v=3.0.0" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="../../front-end/css/material-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../front-end/dataTables/css/dataTables.material.css">

    <link rel="stylesheet" href="../../front-end/custom.css">
</head>

<body style="background-color: #397f9b;">
    <div class="container recuadro-card">
        <div class="card fondo-logout">
            <div class="card-header card-header-success text-white">
                OK!
            </div>
            <div class="card-body">
                <p class="text-white">La sesión se ha cerrado con éxito.</p>
                <p class="text-white">Por motivos de seguridad cierre el navegador.</p>
                <?php
                session_start();
                header('Location: ../../index.php');
                session_destroy();
                ?>
            </div>
        </div>
    </div>
    
    <script src="../../front-end/js/jquery-3.6.0.min.js"></script>
    <script src="../../front-end/js/core/popper.min.js"></script>
    <script src="../../front-end/js/core/bootstrap.min.js"></script>
    <script src="../../front-end/js/jquery.dataTables.min.js"></script>
    <script src="../../front-end/custom.js"></script>
</body>

</html>