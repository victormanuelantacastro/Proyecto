<?php

$alert = '';
session_start();
//Si existe sesión enviar a página de inicioUsuario en caso de no ser administrador, y a inicioAdmin en caso de ser administrador
if (!empty($_SESSION['activo'])) {
    if ($_SESSION['isAdmin'] == 0) {
        header('location: inicioUsuario.php');
    } else {
        header('location: inicioAdmin.php');
    }
} else {
    if (!empty($_POST)) {
        if (empty($_POST['inputUser']) || empty($_POST['inputPassword'])) {
            $alert = "Introduzca su usuario y contraseña";
        } else {
            require_once '../controlador/conexion.php';
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
                header('location: inicioUsuario.php');
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
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/pie.css">
    <link rel="stylesheet" href="../css/fuente.css">
    <title>Tartessos Burger - Index</title>
    <style>
        
        .alert {
            font-weight: bold;
        }
        a {
            color:yellow;
        }

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
                        <li><a class="nav-item nav-link" href="registroUsuario.php">Registrate</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <section id="bajonavbar">
        <div class="container">
            <p class="text-light float-right mt-2">
                <a href="https://www.facebook.com/FairyChinchillas" class="text-light"><i class="fa fa-facebook-square fa-2x">&nbsp;</i></a>
                <a href="https://www.instagram.com" class="text-light"><i class="fa fa-instagram fa-2x"></i></a></i>&nbsp;&nbsp;
                <a href="https://twitter.com" target="_blank" class="text-light"><i class="fa fa-twitter-square fa-2x"></i></a>
            </p>
        </div>

    </section>
    <!--Seccion que contiene spinner en tiempo y enseña imagenes de la ciudad-->
    <section id="ImagenesDeChinchillasComoEjemplo">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="ayunta.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="casadragones.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="castillo.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="muerta.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="puentecristo.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="puerto.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="parque.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="faro.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="castillito.jpg" class="d-block w-100" alt="..." height="540">
                </div>
                <div class="carousel-item">
                    <img src="catedral.jpg" class="d-block w-100" alt="..." height="540">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!--Fin del spinner-->
    <!--Componentes migas de pan-->
    <div class="container ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!--El active del breadcrumb se usa para indicar que es justo ahí donde nos encontramos-->
                <li class="breadcrumb-item active">Inicio</li>
            </ol>
        </nav>
    </div>
    <!--FIN Componentes migas de pan-->
    <!--Seccion que contiene informacion de la ciudad-->
    <section id="estoCeuta">
        <div class="container mt-4">
            <h2 class="text-center">Bienvenidos a WeekEat</h2>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <p class="lead">
                        <!--Con lead aumentamos el tamaño de las letras-->
                        En WeekEat elaboramos menús para
                    <div class="text-center">
                        <img src="mapa.png" alt="mapa" class="imagen-fluid mb-4" width="400">
                    </div>
                    Además Ceuta ofrece a sus visitantes un clima privilegiado, el nivel de contaminación más bajo de España, el único foso
                    navegable de agua salada del mundo, construcciones militares de todas las épocas, el segundo puerto de España por tráfico
                    de pasajeros, uno de los puertos deportivos más transitados del Mediterráneo, un Casino y, por sus especiales condiciones
                    de fiscalidad, la posibilidad de realizar compras de calidad a precios inmejorables.
                    <br>
                    <div class="text-center">
                        <img src="puentecristo.jpg" alt="mapa" class="imagen-fluid mb-4 mt-4" width="400">
                    </div>
                    Ceuta es la puerta de Europa en África. Ceuta es una ciudad para visitar e ir de compras.
                    Ceuta es tranquilidad y sinceridad. Ceuta es exotismo y cultura. Ceuta es gastronomía y vida nocturna. Ceuta es vacaciones
                    para toda la familia. Ceuta es turística. Ceuta es cultural. Ceuta es mar.</p>
                    <div class="text-center">
                        <img src="hercules.jpg" alt="mapa" class="imagen-fluid" width="400">
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Fin de la sección de la información de chinchillas-->
    <!--Seccion que contiene informacion de chinchillas-->
    <section id="ImagenesDeChinchillasComoEjemplo">
        <div class="container mt-4">
            <h2 class="text-center">¿Quienes somos?</h2>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Convivencia cultural</h5>
                            <img src="catedral.jpg" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Diversidad cultural reconocida.</p>

                        </div>
                        <div class="card-footer text-center">
                            <a href="fairychinchillaspgn5.html" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Gastronomía</h5>
                            <img src="campero.jpg" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Productos típicos de la tierra caballa.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="fairychinchillaspgn6.html" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Museos</h5>
                            <img src="museo.jpg" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Recorrido por la historia de la ciudad.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="fairychinchillaspgn7.html" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Geografía y Geología</h5>
                            <img src="geologia.jpg" alt="" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Composición geográfica y geológica.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="fairychinchillaspgn8.html" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Fauna y Flora</h5>
                            <img src="delfin.jpg" alt="" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Biodiversidad Ceutí</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="fairychinchillaspgn10.html" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">En venta</h5>
                            <img src="libro.jpg" class="card-img-top" alt="..." height="170">
                            <p class="card-text"><br> Libro y merchandaising</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="card-link">Leer más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Fin de la sección de la informacion-->
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
    <!--Pagina modal del login-->
    <!--Hidden Login Modal-->
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
                        <button type="submit" class="btn btn-success btn-block" id="iniciaSesion" onclick='mensaje()'>Iniciar sesión</button>
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