<?php

$alert = '';
session_start();
//Si existe sesión enviar a página de inicioUsuario en caso de no ser administrador, y a inicioAdmin en caso de ser administrador
if (!empty($_SESSION['activo'])) {
    if ($_SESSION['isAdmin'] == 0) {
        header('location: vista/inicioUsuario.php');
    } else {
        header('location: vista/inicioAdmin.php');
    }
} else {
    if (!empty($_POST)) {
        if (empty($_POST['inputUser']) || empty($_POST['inputPassword'])) {
            $alert = "Introduzca su usuario y contraseña";
        } else {
            require_once 'controlador/conexion.php';
            $user = $_POST['inputUser'];
            $pass = $_POST['inputPassword'];

            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario = '$user' AND password ='$pass'");
            $resultado = mysqli_num_rows($query);

            if ($resultado > 0) {
                $datos = mysqli_fetch_array($query);
                $_SESSION['activo'] = true; //Esta variable de sesion es creada para comprobar el estado del usuario y que este no pueda ir a las
                //páginas del index una vez logeado , siendo necesario deslogearse para ello
                $_SESSION['dni'] = $datos['dni'];
                $_SESSION['nombre'] = $datos['nombre'];
                $_SESSION['apellidos'] = $datos['apellidos'];
                $_SESSION['direccion'] = $datos['direccion'];
                $_SESSION['codigoPostal'] = $datos['codigoPostal'];
                $_SESSION['telefono'] = $datos['telefono'];
                $_SESSION['usuario'] = $datos['usuario'];
                $_SESSION['password'] = $datos['password'];
                $_SESSION['email'] = $datos['email'];
                $_SESSION['isAdmin'] = $datos['isAdmin'];
                header('location: vista/inicioUsuario.php');
            } else {
                $alert = "Usuario o contraseña incorrectos";
                session_destroy();
            }
        }
    }
}

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="css/pie.css">
    <link rel="stylesheet" href="css/fuente.css">
    <link rel="stylesheet" href="css/inicio.css">

    <title>Tartessos Burger - Index</title>
<style>

</style>
</head>

<body>
    <!--Comienza la cabecera-->
    <header>
        <?php
        if ($alert != '') {
            echo '<div class="alert alert-danger text-center" role="alert center">';
            echo ($alert);
            echo '</div>';
        } ?>

        <!-- se usan las siguientes clases que vienen documentadas en el apartado components -Navbar- No olvides que necesitas la clase container o 
        container-fluid-->
        <nav class="navbar  navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="nav navbar-nav">
                        <li><a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#modalLogin">Accede <span class="sr-only">
                                    (current)</span></a></li>
                        <!--El atributo data-target y data-toggle se usan para conseguir una ventana modal al pulsar en dicho botón con la
                            configuracion de la sesión de login y de registrarse creada casi al final de este código
                            Los data-target son los id de las ventanas de dicho código
                        La clase sr-only es para indicar información oculta pero que será de utilidad para tecnologías de invidetnes-->
                        <li><a class="nav-item nav-link" href="vista/registroUsuario.php">Registrate</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <div class="container-fluid">
        <div class="row">
            <div class="mt-1 mb-2 col-md-12">
                <img src="images/Recurso 7.png" class="img-fluid" alt="local" id="banner" width="1400" height="300">
                <div class="text-center">
                    <a href="https://www.facebook.com/FairyChinchillas"><i class="fa fa-facebook-square fa-3x">&nbsp;</i></a>
                    <a href="https://www.instagram.com"><i class="fa fa-instagram fa-3x">&nbsp;</i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter-square fa-3x"></i></a>
                </div>
            </div>
        </div>
    </div>
    <h1 class="text-center">Bienvenidos a Tartessos Burguer</h1>
    <!--Seccion que contiene informacion del local-->
    <section id="local">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-sm-4 m-4 offset-sm-1">
                    <img src="images/local.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-sm-6 ">
                    <h4 class="text-center">El local</h4>
                    <p class="lead">
                        Somos una hamburguesería con mucha personalidad localizada en Camas. La gran calidad de nuestras carnes, hecha a la brasa con nuestra mezcla de especias secretas, nuestro pan tostado al grill
                        la preparación de la comida en el momento y el amor dedicado a cada elaboración de nuestros productos es una de nuestras señas más importantes. <br>
                        Nuestro local cuenta con capacidad para unos 180 comensales que se dividen entre el salón principal, en el que se ubican unas 22 mesas, y la zona de terraza, habilitada para otras 10.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Fin de la sección de la información del local-->
    <!--Seccion que contiene informacion de la especialidad-->
    <section id="local">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-sm-6 ">
                    <h4 class="text-center">Nuestra especialidad</h4>
                    <p class="lead">
                        Heredados de Granada y afincados también en Málaga y Ceuta, os traemos los míticos CAMPEROS. Molletes de un tamaño mayor al habitual en el cual integramos
                        cada uno de nuestros ingredientes para finalizar el mismo en un tostado de pan al grill, haciendo que cada bocado sea más crujiente y atempere toda
                        la composición del producto. Y si decides añadir nuestros pinchitos (pollo o ternera), podrá disfrutar de nuestra mezcla secreta de especias, que hará
                        que vuestro paladar disfrute de los aromas y sabores de oriente.
                    </p>
                </div>
                <div class="col-sm-4 m-4 offset-sm-1">
                    <img src="images/camperos.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--Fin de la sección de la información de la especialidad-->
    <!--Seccion que contiene informacion de la localizacion-->
    <section id="local">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-sm-4 m-4 offset-sm-1">
                    <img src="images/mapa.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 ">
                    <h4 class="text-center">Donde localizarnos</h4>
                    <div class="lead">
                        Contamos con una ubicación increible nada más y nada menos que en pleno centro de camas. <br>
                        <p class="text-center"><cite>Calle Santa Maria de Gracia nº 32</cite> &nbsp;&nbsp;<a href="https://www.google.com/maps/place/Calle+Sta.+Mar%C3%ADa+de+Gracia,+32,+41900+Camas,+Sevilla/@37.4036168,-6.0360626,18.3z/data=!4m5!3m4!1s0xd126b7cc759f53f:0x290970a473985e95!8m2!3d37.4036589!4d-6.0352114" target='_black'><i class="fa fa-map-marker"></i></a></p>
                        <p>¿A qué estais esperando? Venid !YA¡ a probar nuestros riquísimos camperos , encargarlos via web o a través
                            de nuestro teléfono : <i class="fa fa-phone"></i> <cite>954235687</cite></p>
                    </div>
                    <div class="container" >
                        <div class="row lead">
                            <div class="col-lg-8 ">
                                <p>De Martes a Jueves : <cite>19:00 a 0:00h.</cite> <br>
                                    Viernes a Domingo <cite>12:00 a 16:00h.</cite> <br> <cite>19:00 a 0:00h.</cite> <br>
                                    Lunes CERRADO por descanso del personal</p>
                            </div>
                            <div class="col-lg-4" >
                                <i class="fa fa-hourglass fa-3x mt-4 mb-2 px-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Fin de la sección de la información de la localizacion-->
    <!--Inicio Carrousel-->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-sm-offset-2">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/ensaladacasera.jpg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/camperos.jpg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/patatasfritas.jpg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/nugget.jpg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/fantanaranja.jpg" class="d-block w-30" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Carrousel-->
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
                <img src="images/Recurso 4.png" width="30%" height="auto" alt="logonegro">
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
    <!--Pagina modal del login-->
    <div class="modal fade" id="modalLogin">
        <!--Este id será el que indicaremos en el enlace de login-->
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <!--para incluir este formulario puedes ver las clases necesarios en el apartado css de bootstrap-->
                    <form action="" method="post" id="formuUsuario">
                        <div class="form-group">
                            <label for="inputUser">Nombre de usuario</label>
                            <input type="text" class="form-control" id="inputUser" name="inputUser" placeholder="Escribe tu nombre de usuario...">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Contraseña</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Escribe tu contraseña...">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                <label class="form-check-label" for="dropdownCheck">
                                    Recordar siempre
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block" id="iniciaSesion">Iniciar sesión</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p><a href="#" ?>¿Has olvidado la contraseña</a></p>
                </div>
            </div>
        </div>
    </div>
    <!--FINAL Hidden Login Modal-->
    <!--Final de la pagina modal del login-->
    <!-- Bootstrap Bundle with Popper & jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>