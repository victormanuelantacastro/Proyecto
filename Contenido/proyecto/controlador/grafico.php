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

$mes = $_GET['mes'];
$tipo = $_GET['tipo'];

if ($tipo != "todo") {
    $sql = "SELECT nombre , count(*) AS cantidad , MONTH(fechaCreacion) AS fecha FROM order_items JOIN producto ON producto.id = order_items.product_id
    JOIN orders ON  orders.id = order_items.order_id WHERE MONTH(fechaCreacion)='$mes' AND tipo='$tipo'  group by nombre;";
    $resultado = $conn->query($sql);
} else {
    $sql = "SELECT nombre , count(*) AS cantidad , MONTH(fechaCreacion) AS fecha FROM order_items JOIN producto ON producto.id = order_items.product_id
    JOIN orders ON  orders.id = order_items.order_id WHERE MONTH(fechaCreacion)='$mes'  group by nombre;";
    $resultado = $conn->query($sql);
}


switch ($mes) {
    case 1:
        $nombreMes = "Enero";
        break;
    case 2:
        $nombreMes = "Febrero";
        break;
    case 3:
        $nombreMes = "Marzo";
        break;
    case 4:
        $nombreMes = "Abril";
        break;
    case 5:
        $nombreMes = "Mayo";
        break;
    case 6:
        $nombreMes = "Junio";
        break;
    case 7:
        $nombreMes = "Julio";
        break;
    case 8:
        $nombreMes = "Agosto";
        break;
    case 9:
        $nombreMes = "Septiembre";
        break;
    case 10:
        $nombreMes = "Octubre";
        break;
    case 11:
        $nombreMes = "Noviembre";
        break;
    case 12:
        $nombreMes = "Diciembre";
        break;
}
?>
<html>

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/pie.css">
    <link rel="stylesheet" href="../css/btn.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Nombre', 'Cantidad'],
                <?php
                while ($fila = $resultado->fetch_array()) {
                    echo "['" . $fila['nombre'] . "',  " . $fila['cantidad'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Venta mensual de <?php echo $tipo ?> en el mes de <?php echo $nombreMes ?>'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
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
                                <a class="dropdown-item" href="../vista/inicioAdmin.php">Inicio</a>
                                <a class="dropdown-item" href="../vista/editarAdmin.php">Editar Perfil</a>
                                <a class="dropdown-item" href="salir.php">Salir</a>
                            </div>
                        </li>
                        <li><a class="nav-item nav-link" href="../vista/añadirProducto.php">Añadir producto</a> </li>
                        <li><a class="nav-item nav-link" href="../vista/verProductos.php">Gestionar producto</a> </li>
                        <li><a class="nav-item nav-link" href="../vista/verPedidosPendientes.php">Pedidos pendientes</a> </li>
                        <li><a class="nav-item nav-link" href="../vista/verPedidosFinalizados.php">Pedidos finalizados</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--Final cabecera-->
    <div class="container">
        <div class="row justify-content-center">
            <div id="piechart" style="width: 900px; height: 500px;"></div>
        </div>
        <div class="centro">
        <div class="row text-center">
            <div class="col col-lg-12 mt-1">
                <button class="btn btn-primary  btn-lg"><a href="../vista/inicioAdmin.php">Retroceder</a></button>
            </div>
        </div>
    </div>
    </div>
    <!--Comienza el pie-->
    <footer id="footer" class=" container-fluid mt-4">
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