<?php  

require 'conexion.php';


//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$dni= $conn->real_escape_string($_POST["dni"]);
$nombre= $conn->real_escape_string($_POST["nombre"]);
$apellidos= $conn->real_escape_string($_POST["apellidos"]);
$direccion= $conn->real_escape_string($_POST["direccion"]);
$codigoPostal= $conn->real_escape_string($_POST["cp"]);
$telefono= $conn->real_escape_string($_POST["telf"]);
$usuario= $conn->real_escape_string($_POST["login"]);
$email= $conn->real_escape_string($_POST["email"]);
$pass= $conn->real_escape_string($_POST["password"]);
$isAdmin= 0;

$sql = "INSERT INTO usuario ( dni, nombre , apellidos, direccion, codigoPostal, telefono, usuario, email ,  password , isAdmin) VALUES ('$dni','$nombre','$apellidos','$direccion','$codigoPostal','$telefono','$usuario','$email' , '$pass' , '$isAdmin')";


if ($conn->query($sql) === TRUE) {
  header('location: ../index.php');
} else {
  header('location: ../vista/noCreado.php');
}

$conn->close();


?>