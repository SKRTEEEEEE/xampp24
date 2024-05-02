<?php

session_start();

require_once('connection.php');
echo "Email :".$_SESSION["email"]." Nombre cliente :".$_SESSION["nombre_cliente"];


if(!isset($_SESSION["email"])){

    header('Location: ../index.php');

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
</head>
<body>
    <main><a href="logout.php">Cerrar session</a></main>
</body>
</html>
