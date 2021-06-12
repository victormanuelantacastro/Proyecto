<?php  
require 'conexion.php';

//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$nombre= $conn->real_escape_string($_POST["nombre"]);
$descripcion= $conn->real_escape_string($_POST["descripcion"]);
$precio= $conn->real_escape_string($_POST["precio"]);
$tipo= $conn->real_escape_string($_POST["tipo"]);


$sql = "INSERT INTO producto ( nombre , descripcion, precio, tipo) VALUES ('$nombre','$descripcion','$precio','$tipo')";


if ($conn->query($sql) === TRUE) {
  header('location: ../index.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
