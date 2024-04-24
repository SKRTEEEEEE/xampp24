<?php

//Con el metodo get recuperamos el parámetro correspondiente al valor indicado(id) que llega por la url
$id = $_GET["id"];
// echo "El id es: ".$id;

include_once "connection.php";

$delete = "DELETE FROM info_colores WHERE id = ?";
$delete_prepare = $conn->prepare($delete);
$delete_prepare->execute([$id]);

$delete_prepare = null;
$conn = null;

header("Location: index.php");