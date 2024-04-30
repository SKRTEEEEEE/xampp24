<?php

include_once "connection.php";
include_once "colores.php";

$select = "SELECT * FROM app
WHERE estado = 'white'";


$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos eliminados</title>
</head>
<body>
<header>
            
            <div class="navbar-brand" style="display:flex; height: 15vh; align-items: center" >
                    
                <h1 class="text-center m-5" style="flex-grow: 1; margin: 0;">To Do APP</h1>
                <a href="index.php">
                <img style="flex: end" src="img/back.png" alt="Back button" width="60" height="60">
                </a>
                
                
            </div>
       
        </header>
    
        <main class="container">
            <div class="row gx-5">
                
    
                    <?php foreach ($resultado_select as $row) : ?>
                        <div style="color: white; background-color: black;" class="row alert" role="alert">
                            <div class="col-sm-9">
    
                              <h2><?= $row["titulo"]  ?></h2> <p><?= $row["descripcion"] ?></p>
                            </div>
    
                            <div class="col-sm-3 text-end">
                                <span> <?= $row["fecha_user"] ?></span>
                                <a href="index.php?id=<?= $row["id"] ?>&titulo=<?= $row["titulo"] ?>&estado=<?= $row["estado"] ?>&descripcion=<?= $row["descripcion"] ?>&fecha_user=<?= $row["fecha_user"] ?>">✏️</a>
                                <a href="deleteDelete.php?id=<?= $row["id"] ?>">🗑️</a>
                            </div>
                        </div>
                    <?php endforeach ?>
    
             
                    </main>
</body>
</html>