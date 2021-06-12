<?php
//Traemos la sesión , la destruimos y enviamos al usuario al index
session_start();
session_destroy();
header('location: ../index.php');
