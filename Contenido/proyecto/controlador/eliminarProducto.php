<?php
    require 'conexion.php';
    //Como recibo el parametro mediante un enlace uso el método GET
    $id= $conn->real_escape_string($_GET['id']);

    
    $sql = "DELETE from producto WHERE id='$id'";
    $resultado = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        header ('Location: ../vista/verProductos.php');
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
