<?php

//ESTO ABRE UNA SESION
session_start();

require_once('connection.php');

$email = $_POST['email'];
$password_user = $_POST['password'];
$select = "SELECT * FROM clientes WHERE email = ?";
$query = $conn->prepare($select);
$query->execute([$email]);
$result = $query->fetch();


// var_dump($result);


// POR SI EL LOGIN NO ES CORRECTO
if (!$result) {
    echo "El usuario o contraseña incorrectos";
    // header('location: ecommerce.php');

    die();
}


// CUANDO EL LOGIN ES CORRECTO Y OBTENEMOS LOS DATOS DEL CLIENTE
$password_hash = $result['password'];

if (password_verify($password_user, $password_hash)) {
    // echo "Usuario y contraseña correcto";
    $_SESSION['nombre_cliente'] = $result['nombre_cliente'];
    $_SESSION['apellido_cliente'] = $result['apellido_cliente'];
    // echo 'usuario: '.$_SESSION['nombre_cliente'];

    header('location: ecommerce.php');
} else {
    echo "Usuario o contraseña incorrectos";
}

;