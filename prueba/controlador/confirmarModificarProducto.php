<?php  

require 'conexion.php';


//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$id= $conn->real_escape_string($_POST["id"]);
$nombre= $conn->real_escape_string($_POST["nombre"]);
$descripcion= $conn->real_escape_string($_POST["descripcion"]);
$precio= $conn->real_escape_string($_POST["precio"]);
$tipo= $conn->real_escape_string($_POST["tipo"]);

$sql = "UPDATE producto SET nombre='$nombre', descripcion='$descripcion', precio='$precio', tipo='$tipo' WHERE id='$id'";


if ($conn->query($sql) === TRUE) {
  header ('Location: ../vista/verProductos.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>