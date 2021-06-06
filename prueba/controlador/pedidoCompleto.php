<?php  

// incluyo la conexión a la base de datos
include 'conexion.php';
session_start();

//Si el usuario no tiene sesión activa mandalo al index, y si tiene sesión activa y isAdmin = 1 mándalo a la página de administración
if (empty($_SESSION['activo'])) {
    header('location: ../vista/index.php');
} else if (!empty($_SESSION['activo']) && $_SESSION['isAdmin'] == 0) {
    header('location: ../vista/inicioUsuario.php');
}

//Como recibo el parametro mediante un enlace uso el método GET
$id= $conn->real_escape_string($_GET['id']);

    
$sql = "SELECT *  FROM order_items left JOIN producto ON producto.id = order_items.product_id
JOIN orders ON  orders.id = order_items.order_id WHERE order_id='$id';";
$resultado = $conn->query($sql);

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/pie.css">
    <link rel="stylesheet" href="../css/fuente.css">
    <link rel="stylesheet" href="../css/btn.css">
    <!-- Bootstrap Bundle with Popper & jquery-->
    <script src="../js/jquery-3.6.0.min.js"></script>



    <title>Gestionar Productos</title>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
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
                                <?php echo $_SESSION['usuario'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="inicioAdmin.php">Inicio</a>
                                <a class="dropdown-item" href="../controlador/salir.php">Salir</a>
                            </div>
                        </li>
                        <li><a class="nav-item nav-link" href="añadirProducto.php">Añadir producto</a> </li>
                        <li><a class="nav-item nav-link" href="verProductos.php">Gestionar producto</a> </li>
                        <li><a class="nav-item nav-link" href="verPedidosPendientes.php">Pedidos pendientes</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <div class="container-fluid mb-3">
        <div class="row justify-content-center">
            <h1>Productos del pedido nº : <?php echo $id ?></h1>
        </div>

        <table id="tabla" class="row-sm-12" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fila['nombre'] ?></td>
                        <td><?php echo $fila['cantidad'] ?></td>
                        <td><?php echo $fila['tipo'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <div class="centro">
        <div class="form-group row text-center">
            <div class="col col-lg-12 mt-1">
                <button class="btn btn-primary  btn-lg"><a href="../vista/inicioAdmin.php">Retroceder</a></button>
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
                    <img src="../images/Recurso 4.png"  width="30%" height="auto" alt="logonegro">
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
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
</body>

</html>