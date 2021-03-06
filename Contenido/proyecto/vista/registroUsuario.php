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
    <link rel="stylesheet" href="../css/btn.css">


    <title>Registro Usuario</title>

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
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="nav navbar-nav">
                        <li><a class="nav-item nav-link" href="../index.php">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <!--Inicio contenido-->
    <div class="container-fluid mb-2">
        <div class="row text-center">
            <div class="col-lg-12">
                <h1>Registro de usuario:</h1>
            </div>
        </div>
        <form action="../controlador/confirmarRegistro.php" method="POST" autocomplete="off">
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">DNI: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="dni" id="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Introduzca 8 n??meros y una letra" autofocus required>
                </div>
            </div>

            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Nombre: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="nombre" id="nombre" pattern="[a-zA-Z??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-]{2,40}" title="Introduzca entre 2 y 40 letras" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Apellidos: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="apellidos" id="apellidos" pattern="[a-zA-Z??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-]{2,40}" title="Introduzca entre 2 y 40 letras" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Direccion: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="direccion" id="direccion" pattern="[a-zA-Z0-9??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-????]{10,75}" title="Introduzca entre 2 y 40 letras" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Codigo Postal: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="cp" id="cp" pattern="41900|41910" title="Introduzca el c??digo postal de Camas" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Telefono: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="telf" id="telf" pattern="[0-9]{9}" title="Introduzca 9 n??meros" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Usuario: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="login" id="login" pattern="[a-zA-Z0-9??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-]{5,25}" title="Introduzca entre 5 y 25 caracteres" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Contrase??a: </label>
                <div class="col-lg-6">
                    <input type="password" class="form-control" name="password" id="password" patter="^[a-zA-Z0-9.!#$%&???*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$" required>
                </div>
            </div>
            <div class="form-group row justify-content-md-center text-center">
                <label class="col-lg-12 col-form-label">Email: </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="email" id="email" patter="^[a-zA-Z0-9.!#$%&???*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$" placeholder="XXX@XXX.XXX" required>
                </div>
            </div>

            <div class="centro">
                <div class="form-group row text-center">
                    <div class="col-12 col-lg-12 mt-1">
                        <button type="submit" class="btn btn-success btn-lg" id="a??adir">Registrar</button>
                        <button class="btn btn-primary  btn-lg"><a href="inicioUsuario.php">Retroceder</a></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Comienza el pie-->
    <footer id="footer" class=" container-fluid">
        <div class="row text-center">
            <div class="col-12 col-lg-4">
                <h3>Nos encontramos en...</h3>
                <div>
                    <ul>
                        <li><strong>Calle Santa Maria de Gracia n?? 32 </strong></li>
                        <li> <a href="https://www.google.com/maps/place/Calle+Sta.+Mar%C3%ADa+de+Gracia,+32,+41900+Camas,+Sevilla/@37.4036168,-6.0360626,18.3z/data=!4m5!3m4!1s0xd126b7cc759f53f:0x290970a473985e95!8m2!3d37.4036589!4d-6.0352114" target='_black'>Ver mapa &nbsp;</a><i class="fa fa-map-marker"></i></li>
                        <li>??????Haz tu pedido!!!</li>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>



</body>

</html>