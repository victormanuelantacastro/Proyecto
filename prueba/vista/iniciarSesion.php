<?php  

$alert='';
session_start();
//Si existe sesión enviar a página de inicioUsuario en caso de no ser administrador, y a inicioAdmin en caso de ser administrador
if(!empty($_SESSION['activo'])){
    if ($_SESSION['isAdmin'] == 0 ) {
        header('location: inicioUsuario.php');
    }else{
        header('location: inicioAdmin.php');
    }
}else{
    if(!empty($_POST)){
        if(empty($_POST['inputUser']) || empty($_POST['inputPassword'])){
            $alert = "Introduzca su usuario y contraseña";
        }else{
            require_once '../conexion.php';
            $user = $_POST['inputUser'];
            $pass = $_POST['inputPassword'];
            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario = '$user' AND password ='$pass' AND active='1'");
            $resultado = mysqli_num_rows($query);

            if($resultado >0){
                $datos = mysqli_fetch_array($query);
                $_SESSION['activo'] = true;//Esta variable de sesion es creada para comprobar el estado del usuario y que este no pueda ir a las
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
            }else{
                $alert = "Usuario o contraseña incorrectos";
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/fuente.css">
</head>
<body>
    <section id="container">
        <form action="" method="post">
            <h3>Iniciar sesión</h3>
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
            <div class="form-group">
                <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> 
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block" id="iniciaSesion" onclick= 'mensaje()'>Iniciar sesión</button>
        </form>
    </section>

    <!-- Bootstrap Bundle with Popper & jquery-->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>