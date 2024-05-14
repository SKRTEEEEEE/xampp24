<?php

$jsonFilePath = 'employees.json';
$jsonData = file_get_contents($jsonFilePath);
$empleados = json_decode($jsonData, true);
$user = $_POST["email"];
$pass = $_POST["password"];

$encontrado = false;

foreach ($empleados as $empleado) {
    // echo $empleado['email'] . ' ' . $empleado['key'] . ' ' . '<br>';
    if ($empleado['email'] == $user && $empleado['key'] == $pass) {
        echo 'Bienvenido ' . $empleado['name'] . " " . $empleado["surname"] . '<br> Nacido: ' . $empleado["dateBirth"] . '<br> Email: ' . $empleado["email"];
        $encontrado = true;
        break;
    } 
    
}
if (!$encontrado) {
    header('Location: index.php');
    exit(); // para que no siga ejecutando el resto del código (por si hay algún error)
}
