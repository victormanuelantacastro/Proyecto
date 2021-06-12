<?php
// Inicializo la clase cart
include 'cart.php';
$cart = new Cart;

// incluyo la conexión a la base de datos
include '../controlador/conexion.php';

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // Cojo los detalles del producto
        $query = $conn->query("SELECT * FROM producto WHERE id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'precio' => $row['precio'],
            'qty' => 1
        );
        
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'../vista/viewCart.php':'index.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: ../vista/viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['dni'])){
        // inserto el pedido en la base de datos
        $insertOrder = $conn->query("INSERT INTO orders (dni_usuario, precio_total, fechaCreacion) VALUES ('".$_SESSION['dni']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $conn->insert_id;
            $sql = '';
            // Cojo los items del carro
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, cantidad) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $conn->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: ../vista/orderSuccess.php?id=$orderID");
            }else{
                header("Location: ../vista/checkout.php");
            }
        }else{
            header("Location: ../vista/checkout.php");
        }
    }else{
        header("Location: ../vista/index.php");
    }
}else{
    header("Location: ../vista/index.php");
}