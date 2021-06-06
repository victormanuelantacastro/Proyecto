<?php  

require 'conexion.php';
require 'PHPMailer.php';
require 'SMTP.php';

//$conn->real_escape_string(variable que tomo del formulario)-->Con esto consigo que no introduzca codigo malintencionado
$dni= $conn->real_escape_string($_POST["dni"]);
$nombre= $conn->real_escape_string($_POST["nombre"]);
$apellidos= $conn->real_escape_string($_POST["apellidos"]);
$direccion= $conn->real_escape_string($_POST["direccion"]);
$codigoPostal= $conn->real_escape_string($_POST["cp"]);
$telefono= $conn->real_escape_string($_POST["telf"]);
$usuario= $conn->real_escape_string($_POST["login"]);
$email= $conn->real_escape_string($_POST["email"]);
$hash= md5(rand(0,1000));
$pass= md5(rand(1000,5000));
$isAdmin= 0;

$sql = "INSERT INTO usuario ( dni, nombre , apellidos, direccion, codigoPostal, telefono, usuario, email , hash , password , isAdmin) VALUES ('$dni','$nombre','$apellidos','$direccion','$codigoPostal','$telefono','$usuario','$email' , '$hash' ,'$pass' , '$isAdmin')";


if ($conn->query($sql) === TRUE) {
  echo "Usuario registrado con éxito";
  header('location: ../vista/index.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

/*$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject */
$message = '
 
¡Gracias por registrarte!<br>
Su cuenta ha sido creada, puede iniciar sesión con las siguientes credenciales después de haber activado su cuenta presionando la URL que encontrará a continuación.<br>
 
<br>------------------------<br>
Usuario: '.$usuario.'<br>
Contraseña: '.$pass.'<br>
------------------------<br><br>
 
Haga clic en este enlace para activar su cuenta:<br>
http://localhost/prueba/vista/verify.php?email='.$email.'&hash='.$hash.'<br>
 
'; // Mensaje enviado al nuevo usuario que incluse los datos de acceso y link de activación
                     

try{
  $mail=new PHPMailer();
  $mail->CharSet = 'UTF-8';
  $mail->IsSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;
  $mail->SMTPDebug  = 1;
  $mail->SMTPAuth   = true;
  $mail->Username   = 'victormanuelantacastro87@gmail.com';
  $mail->Password   = 'mierda87';
  $mail->SetFrom('victormanuelantacastro87@gmail.com', "Victor Anta");
  $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
  $mail->Subject    = 'Activación de cuenta de usuario';
  $mail->MsgHTML($message);
  $mail->AddAddress($email , $nombre );
  $mail->send();
} catch (Exception $e) {
    echo "Mailer";
}
?>