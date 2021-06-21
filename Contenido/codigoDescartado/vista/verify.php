<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/pie.css">
    <link rel="stylesheet" href="../css/fuente.css">

    <title>Registro Usuario</title>
    <style>


        h1 {
            margin: 0 auto;
            padding-bottom: 1%;
        }

        .statusmsg {
            justify-content: center;
            color: green;
        }
    </style>
</head>

<body>
    <!--Comienza la cabecera-->
    <header>
        <!-- se usan las siguientes clases que vienen documentadas en el apartado components -Navbar- No olvides que necesitas la clase container o 
        container-fluid-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid ">
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <ul class="nav navbar-nav">
                        <li class="navbar-nav mr-auto">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="inicioUsuario.php">Inicio</a>
                                <a class="dropdown-item" href="editarUsuario.php">Editar Perfil</a>
                                <a class="dropdown-item" href="../controlador/salir.php">Salir</a>
                            </div>
                        </li>
                        <li><a class="nav-item nav-link" href="entrante.php">Entrantes</a> </li>
                        <li><a class="nav-item nav-link" href="bocadillo.php">Bocadillos Y Camperos</a> </li>
                        <li><a class="nav-item nav-link" href="bebida.php">Bebida</a> </li>
                        <li><a class="nav-item nav-link" href="verEstadoPedido.php">Siga el estado de su pedido</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <div class="container-sm">
        <div class="row">
            <h1>Registro de usuario:</h1>
        </div>
        <div class="row">
            <?php
            include '../controlador/conexion.php';
            if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
                // Verify data
                $email = $_GET['email']; // establezco la variable email
                $hash = $_GET['hash']; // establezco la variable hash
                $search = mysqli_query($conn, "SELECT email, hash, active FROM usuario WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'");
                $match  = mysqli_num_rows($search);

                if ($match > 0) {
                    // Tenemos coincidencia, activamos la cuenta
                    mysqli_query($conn, "UPDATE usuario SET active='1' WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'");
                    echo '<div class="statusmsg offset-lg-3">&nbsp;&nbsp;Su cuenta ha sido activada, ahora puede iniciar sesión</div>';
                } else {
                    // Sin coincidencias -> url invalida o la cuenta ya ha sido activada.
                    echo '<div class="statusmsg offset-lg-3">&nbsp;&nbsp;La URL no es válida o ya ha activado su cuenta.</div>';
                }
            } else {
                // Enlace no válido
                echo '<div class="statusmsg offset-lg-3">&nbsp;&nbsp;Enlace no válido, utilice el enlace que se ha enviado a su correo electrónico.</div>';
            }
            ?>
        </div>
        <div class="col offset-lg-4 mt-1 mb-2">
            <a class="btn btn-primary btn-lg" href="../index.php ">Retroceder</a>
        </div>
    </div>
    <!--Comienza el pie-->
    <footer id="footer" class=" container-fluid">
        <div class="row text-center">
            <div class="col-12 col-lg-4">
                <h3>Nos encontramos en...</h3>
                <div>
                    <ul>
                        <li><strong>Calle Santa Maria de Gracia nº 32 </strong></li>
                        <li> <a href="https://www.google.com/maps/place/Calle+Sta.+Mar%C3%ADa+de+Gracia,+32,+41900+Camas,+Sevilla/@37.4036168,-6.0360626,18.3z/data=!4m5!3m4!1s0xd126b7cc759f53f:0x290970a473985e95!8m2!3d37.4036589!4d-6.0352114" target='_black'>Ver mapa &nbsp;</a><i class="fa fa-map-marker"></i></li>
                        <li>¡¡¡Haz tu pedido!!!</li>
                        <li>O llama al <i class="fa fa-phone"></i> 954235687</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-4 mt-1">
                <img src="../images/Recurso 4.png" width="30%" height="auto" alt="logonegro">
            </div>
            <div class="col-12 col-lg-4">
                <h3>Siguenos en...</h3>
                <div>
                    <ul>
                        <li><a href="https://www.facebook.com/FairyChinchillas">Facebook &nbsp;<i class="fa fa-facebook-square fa-2x"></i></a></li>
                        <li><a href="https://www.instagram.com">Instagram &nbsp;<i class="fa fa-instagram fa-2x"></i></a></i></li>
                        <li><a href="https://twitter.com" target="_blank">Twitter &nbsp;<i class="fa fa-twitter-square fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--Final pie-->
    <!-- Bootstrap Bundle with Popper & jquery-->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>



</body>

</html>