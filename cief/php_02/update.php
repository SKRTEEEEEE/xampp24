<?php 
include_once "connection.php";
include_once "colores.php";


// echo $_GET['id'],"<br>";
// echo $_GET['titulo'],"<br>";
// echo $_GET['estado'],"<br>";
// echo $colores[$_GET['estado_user']];



$id = $_GET['id'];
$titulo = $_GET['titulo'];
$estado = $_GET['estado'];
$colorines = $colores[$estado];
$descripcion = $_GET['descripcion'];
$fecha_user = $_GET["fecha_user"];

// select * from info_colores where id = $_GET['id'];



    $update = "UPDATE app SET titulo = ?, estado = ?, estado_user = ?, descripcion = ? , fecha_user = ? WHERE id = ?";
    $update_prepare = $conn->prepare($update);
    $update_prepare->execute([$titulo, $estado, $colorines, $descripcion, $fecha_user ,$id]);

    $update_prepare = null;
    $conn = null;


    header("location:index.php");