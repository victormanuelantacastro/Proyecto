<?php  

$servername = "localhost";
$database = "proyecto";
$username = "root";
$password = "root";

// Creo la conexion a mi bd
$conn = new mysqli($servername, $username, $password, $database);
// Compruebo la conexión
if ($conn->connect_error) {
  die("Error en la conexión: " . $conn->connect_error);
}

?>