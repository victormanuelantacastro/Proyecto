<?php  
session_start();
require 'conexion.php';


//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$usuario= $conn->real_escape_string($_POST["login"]);
$pass= $conn->real_escape_string($_POST["pass"]);//recoger datos de la pass

$sql = "UPDATE usuario SET  password='$pass' WHERE usuario='$usuario'";


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
  header('location: ../vista/editarAdmin.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
