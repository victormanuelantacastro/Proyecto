<?php  
session_start();
require 'conexion.php';


//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$dni= $conn->real_escape_string($_POST["dni"]);
$nombre= $conn->real_escape_string($_POST["nombre"]);
$apellidos= $conn->real_escape_string($_POST["apellidos"]);
$direccion= $conn->real_escape_string($_POST["direccion"]);
$codigoPostal= $conn->real_escape_string($_POST["cp"]);
$telefono= $conn->real_escape_string($_POST["telf"]);
$usuario= $conn->real_escape_string($_POST["login"]);
$pass= $conn->real_escape_string($_POST["pass"]);//recoger datos de la pass
$email= $conn->real_escape_string($_POST["email"]);//recoger datos del email

$sql = "UPDATE usuario SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', codigoPostal='$codigoPostal', 
telefono='$telefono', usuario='$usuario', password='$pass', email='$email' WHERE dni='$dni'";


if ($conn->query($sql) === TRUE) {
  $_SESSION['activo'] = true;
  $_SESSION['dni'] = $dni; 
  $_SESSION['nombre'] = $nombre; 
  $_SESSION['apellidos'] = $apellidos; 
  $_SESSION['direccion'] = $direccion; 
  $_SESSION['codigoPostal'] = $codigoPostal; 
  $_SESSION['telefono'] = $telefono; 
  $_SESSION['usuario'] = $usuario; 
  $_SESSION['password'] = $pass;
  $_SESSION['email'] = $email;
  header('location: ../vista/editarUsuario.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
