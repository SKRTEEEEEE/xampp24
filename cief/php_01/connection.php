<?php


//PDO -> Clase que genera una conexión. Tenemos unos métodos exclusivos

$serverName = "127.0.0.1";
$userName = "cief";
$password = "Cief+2024";
$dbName = "colores";

$link = "mysql:host=$serverName; port=3306; dbname=$dbName;";

try {
    $conn = new PDO($link, $userName, $password);
    // echo "Echo capuccinho";
} catch (PDOException $e) {
    //-- Tipos Errores principales?
    //PDOException $e
    //exception $e
    //throw $th;
    print("Error: ". $e->getMessage()); // -> para encadenar
} catch (Exception $e){
    print("Error: ". $e->getMessage());
}


