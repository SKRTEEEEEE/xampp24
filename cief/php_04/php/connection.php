<?php

// Parámetros de la conexión
$adress = "127.0.0.1";
$user = "cief";
$password = "Cief+2024";
$database = "e-comerce";

// Conexión a la base de datos
$link = "mysql:host=$adress;port=3306;dbname=$database";

try {

    $conn = new PDO($link, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->exec("SET CHARACTER SET utf8");
    $conn->exec("SET NAMES utf8");
    $conn->exec("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
    $conn->exec("SET CHARACTER_SET_CLIENT = 'utf8'");
    $conn->exec("SET CHARACTER_SET_RESULTS = 'utf8'");
    $conn->exec("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

    echo "Conexión realizada <br>";


} catch (Exception $e) {
    echo "Error: ". $e->getMessage();
}