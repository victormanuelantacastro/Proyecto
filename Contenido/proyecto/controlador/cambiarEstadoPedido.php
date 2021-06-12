<?php  

require 'conexion.php';

//Como recibo el parametro mediante un enlace uso el método GET
$id= $conn->real_escape_string($_GET['id']);

    
$sql = "SELECT * from orders WHERE id='$id'";
$resultado = $conn->query($sql);

$fila = $resultado->fetch_assoc(); 

if($fila['estado'] ==0){
  $sql = "UPDATE orders SET estado=1 WHERE id='$id'";
}
if($fila['estado'] ==1){
  $sql = "UPDATE orders SET estado=2 WHERE id='$id'";
}
if($fila['estado'] ==2){
  $sql = "UPDATE orders SET estado=3 WHERE id='$id'";
}
if($fila['estado'] ==3){
  $sql = "UPDATE orders SET estado=4 WHERE id='$id'";
}

if ($conn->query($sql) === TRUE) {
  header ('Location: ../vista/verPedidosPendientes.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>