<?php

include_once "connection.php";
include_once "const.php";

$usuario = $_GET["usuario"];
$id = $_GET["id"];
$color = $_GET["color"];
$usuario = $_GET["usuario"];
$colorTrans = $colores[$color];
echo "Usuario :". $usuario. "Color :".$color."Id: ".$id."Color: ".$colorTrans;
$update = "UPDATE info_colores SET color_user = ?, color = ?, usuario = ? WHERE id = ?";
    //El prepare() y el execute() le dan seguridad a la app
    $update_prepare = $conn->prepare($update);
    $update_prepare->execute([ $colores[$color], $color, $usuario, $id]);

    $update_prepare = null;
    $conn = null;

    header("Location: index.php");


include_once "connection.php";