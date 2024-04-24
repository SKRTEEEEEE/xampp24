<?php

include_once "connection.php";
include_once "const.php";

$id = $_GET["id"];
$estado = $_GET["estado"];
$titulo = $_GET["titulo"];
$descripcion = $_GET["descripcion"];
$estadoTrans = $estados[$estado];
echo "titulo :". $titulo. "estado :".$estado."Id: ".$id."estado: ".$estadoTrans."descripcion: ".$descripcion;
$update = "UPDATE app SET estado_user = ?, estado = ?, titulo = ?, descripcion = ? WHERE id = ?";
    //El prepare() y el execute() le dan seguridad a la app
    $update_prepare = $conn->prepare($update);
    $update_prepare->execute([ $estados[$estado], $estado, $titulo, $descripcion, $id]);

    $update_prepare = null;
    $conn = null;

    header("Location: index.php");


include_once "connection.php";