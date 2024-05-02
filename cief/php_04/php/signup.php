<?php
session_start();
require_once('connection.php');
//Cuando recibe el POST (desde app.js) el echo de devuelve lo que le pongamos
// echo "PHP obtiene: ".file_get_contents("php://input");


// Comprovar el post quefuncione
// echo "<pre>";
// var_dump($data);
// echo "</pre>";

// Al recivir el JSON, php lo ha de vovler a pasar a JSON ya que lo recibe como un "documento plano"

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$apellidos = $data['apellidos'];
$password = $data['password'];
// $password2 = $data['password2'];
$email = $data['email'];
$nif = $data['nif'];
$telefono = $data['telefono'];
$direccion = $data['direccion'];
$ciudad = $data['ciudad'];

// AQUI VAMOS A CODIFICAR LA CONTRASEÑA

// AQUI ENCRIPTAMOS LA CONTRASEÑA
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// echo strlen($passwordHash);


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


try{
    //Conexion
    $insert = "INSERT INTO clientes (nombre_cliente, apellido_cliente, password, email, nif, telefono, direccion_cliente, id_ciudad) VALUES (?,?,?,?,?,?,?,?)";
    $query = $conn->prepare($insert);
    $query->execute([$nombre, $apellidos, $passwordHash, $email, $nif, $telefono, $direccion, $id_ciudad]);

    $_SESSION['email'] = $email;
    $_SESSION['nombre_cliente'] = $nombre;
    $_SESSION['apellido_cliente'] = $apellidos;

    
    $insert = null;
    $select = null;
    $conn = null;

    // header('location: ecommerce.php');
} catch(PDOException $e){
    echo "Error: " . $e->getMessage();
};

