<?php
//Incluyo la conexión a la base de datos
include '../controlador/conexion.php';
//Traemos la sesion
session_start();
//Si el usuario no tiene sesión activa mandalo al index, y si tiene sesión activa y isAdmin = 1 mándalo a la página de administración
if (empty($_SESSION['activo'])) {
    header('location: ../index.php');
} else if (!empty($_SESSION['activo']) && $_SESSION['isAdmin'] == 1) {
    header('location: inicioAdmin.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Bocadillos y Camperos</title>
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/pie.css">
    <link rel="stylesheet" href="../css/fuente.css">
    <link rel="stylesheet" href="../css/productos.css">

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
                                <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['usuario'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="inicioUsuario.php">Inicio</a>
                                <a class="dropdown-item" href="editarUsuario.php">Editar Perfil</a>
                                <a class="dropdown-item" href="../controlador/salir.php">Salir</a>
                            </div>
                        </li>
                        <li><a class="nav-item nav-link" href="entrante.php">Entrantes</a> </li>
                        <li><a class="nav-item nav-link" href="bebida.php">Bebida</a> </li>
                        <li><a class="nav-item nav-link" href="verEstadoPedido.php">Estado de su pedido</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <div class="container-fluid mb-4 mt-4">
        <h1>Bocadillos y Camperos</h1>
        <a href="viewCart.php" class="text-dark" title="View Cart"><i class="fa fa-shopping-cart fa-2x"></i></a>
    </div>
    <!--Inicio Carrousel-->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-sm-offset-2">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../images/bocadillo.jpeg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/campero.jpeg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/campero.jpg" class="d-block w-30" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/camperos.jpg" class="d-block w-30" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Carrousel-->
    <div class="container-fluid">
        <div class="row text-center">
            <?php
            //get rows query
            $query = $conn->query("SELECT * FROM producto WHERE tipo='Bocata' ORDER BY id ASC LIMIT 30");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
            ?>
                    <div class="col-lg-2 ml-3 mb-4">
                        <h4 class="list-group-item-heading"><?php echo $row["nombre"]; ?></h4>
                        <p class="list-group-item-text"><?php echo $row["descripcion"]; ?></p>
                        <p class="lead"><?php echo $row["precio"] . ' €'; ?></p>
                        <div id="pie">
                            <a class="btn btn-success my-2" href="../controlador/cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">Añadir al carro</a>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p>Producto(s) no encontrado.....</p>
            <?php } ?>
        </div>
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-sm-12 mb-2">
                    <a class="btn btn-primary btn-lg" href="inicioUsuario.php">Retroceder</a>
                </div>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>