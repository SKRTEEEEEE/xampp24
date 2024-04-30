<?php

require_once('connection.php');


// Comprovar el post quefuncione
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$nif = $_POST['nif'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];

// AQUI VAMOS A CODIFICAR LA CONTRASEÑA

// AQUI ENCRIPTAMOS LA CONTRASEÑA
$password1 = password_hash($password1, PASSWORD_DEFAULT);
// echo strlen($password1);


$select = "SELECT * FROM clientes WHERE email = ?";
$query = $conn->prepare($select);
$query->execute([$email]);
$result = $query->fetch();

//Comprobamos el result q sirve par que solo haya un cliente por email
// echo "<pre>";
// var_dump($result);
// echo "</pre>";

if ($result) {
    echo "El email ya existe";
    die();
}

// echo "<pre>";
// var_dump('id_ciudad');
// echo "</pre>";


if (!$result) {
    // INSERTAR LA CIUDAD
    $insert = "INSERT INTO ciudades (nombre_ciudad) VALUES (?)";
    $query = $conn->prepare($insert);
    $query->execute([$ciudad]);
    $result = $query->fetch();

    // OBTENER EL ID DE LA CIUDAD
    $select = "SELECT id_ciudad FROM ciudades WHERE nombre_ciudad = ?";
    $query = $conn->prepare($select);
    $query->execute([$ciudad]);
    $result = $query->fetch();
}

$id_ciudad = $result['id_ciudad'];



$insert = "INSERT INTO clientes (nombre_cliente, apellido_cliente, password, email, nif, telefono, direccion_cliente, id_ciudad) VALUES (?,?,?,?,?,?,?,?)";
$query = $conn->prepare($insert);
$query->execute([$nombre, $apellidos, $password1, $email, $nif, $telefono, $direccion, $id_ciudad]);

$conn = null;
$insert = null;
$select = null;

header('location: ecommerce.php');
