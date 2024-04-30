<?php

include_once "connection.php";
include_once "colores.php";


$select = "SELECT * FROM app
WHERE estado != 'white'
ORDER BY 
  CASE 
      WHEN estado = 'darkred' THEN 1
      WHEN estado = 'darkorange' THEN 2
      WHEN estado = 'darkblue' THEN 3
      WHEN estado = 'darkgreen' THEN 4
      ELSE 5 END,
      fecha DESC";


$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll(); //aquí se guarda la información de la tabla

if ($_POST) {

    $descripcion = $_POST["descripcion"];
    $titulo = $_POST["titulo"];
    $estado = $_POST["estado"];
    $colorines = $colores[$estado];
    $fecha_user = $_POST["fecha_user"];


    $insert = "INSERT INTO app (estado, titulo, estado_user, descripcion, fecha_user) values (?,?,?,?,?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$estado, $titulo, $colorines, $descripcion, $fecha_user]);

    $insert_prepare = null;
    $conn = null;

    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organización de tareas</title>
</head>

<body>

    <header>
            
        <div class="navbar-brand" style="display:flex; height: 15vh; align-items: center" >
                
            <h1 class="text-center m-5" style="flex-grow: 1; margin: 0;">To Do APP</h1>
            <a href="deletePage.php">
            <img style="flex: end" src="img/delete.png" alt="Delete button" width="60" height="60">
            </a>
            
            
        </div>
   
    </header>

    <main class="container">
        <div class="row gx-5">
            <section class="col-sm-6 section1">

                <?php foreach ($resultado_select as $row) : ?>
                    <div style="color: white; background-color: <?= $row["estado"] ?>" class="row alert" role="alert">
                        <div class="col-sm-9">

                          <h2><?= $row["titulo"]  ?></h2> <p><?= $row["descripcion"] ?></p>
                        </div>

                        <div class="col-sm-3 text-end">
                            <span> <?= $row["fecha_user"] ?></span>
                            <a href="index.php?id=<?= $row["id"] ?>&titulo=<?= $row["titulo"] ?>&estado=<?= $row["estado"] ?>&descripcion=<?= $row["descripcion"] ?>&fecha_user=<?= $row["fecha_user"] ?>">✏️</a>
                            <a href="delete.php?id=<?= $row["id"] ?>">🗑️</a>
                        </div>
                    </div>
                <?php endforeach ?>

            </section>


            <section class="col-sm-6 section2">

                <?php if ($_GET) : ?>
                    <fieldset>
                            <legend>Actualiza la información</legend>
                    <form method="GET" action="update.php">
                        <div class="mb-3">
                            <input type="hidden" name="id" value='<?= $_GET['id']?>'>
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp" value='<?=$_GET['titulo'] ?>'>
                            <div id="tituloHelp" class="form-text">Titulo de la tarea, máximo 50 caracteres.</div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="id" value='<?= $_GET['id']?>'>
                            <label for="titulo" class="form-label">descripción</label>
                            <input type="text" name="descripcion" class="form-control" id="descripcion" aria-describedby="descripcionHelp" value='<?=$_GET['descripcion'] ?>'>
                            <div id="descripcionHelp" class="form-text">Descripción de la tarea, máximo 250 caracteres.</div>
                        </div>
                        <div class="mb-3">
                                <label for="fecha_user" class="form-label">Fecha limite</label>
                                <input type="date" name="fecha_user" class="form-control" id="fecha_user" aria-describedby="fecha_userHelp" value='<?=$_GET["fecha_user"]?>'>
                                <div id="fecha_userHelp" class="form-text">Fecha limite o de ejecución de la tarea.</div>
                            </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select name="estado" id="estado">
                                <option value="darkred" <?php if ($_GET['estado'] == "darkred") echo "selected" ?>>Urgente</option>
                                <option value="darkorange" <?php if ($_GET['estado'] == "darkorange" || $_GET['estado'] == "white") echo "selected" ?>>Pendiente</option>
                                <option value="darkblue" <?php if ($_GET['estado'] == "darkred") echo "selected" ?>>Ejecutando</option>
                                <option value="darkgreen" <?php if ($_GET['estado'] == "darkgreen") echo "selected" ?>>Finalizado</option>
                            </select>
                        </div>
                        <div class="row gap-3">
                            <button type="submit" class=" col btn btn-primary">Editar</button>
                            <button type="reset" class=" col btn btn-danger">Limpiar</button>
                        </div>
                        <div class="my-3">
                            <p class="text-center">
                            <a href="index.php">Dejar de editar</a>
                            </p>
                        </div>
                    </form>
                    </fieldset>
                <?php endif ?>



                <?php if (!$_GET) : ?>
                    <form method="post">
                        <fieldset>
                                <legend>Introduce los datos</legend>
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp">
                                <div id="tituloHelp" class="form-text">Titulo de la tarea, máximo 50 caracteres.</div>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" id="descripcion" aria-describedby="descripcionHelp">
                                <div id="descripcionHelp" class="form-text">Descripción de la tarea, máximo 250 caracteres.</div>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_user" class="form-label">Fecha limite</label>
                                <input type="date" name="fecha_user" class="form-control" id="fecha_user" aria-describedby="fecha_userHelp">
                                <div id="fecha_userHelp" class="form-text">Fecha limite o de ejecución de la tarea.</div>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <select name="estado" id="estado">
                                    <option value="darkred">Urgente</option>
                                    <option value="darkorange" selected>Pendiente</option>
                                    <option value="darkblue">Ejecutando</option>
                                    <option value="darkgreen">Finalizado</option>
                                </select>
                            </div>
                            <div class="row gap-3">
                                <button type="submit" class=" col btn btn-primary">Guardar</button>
                                <button type="reset" class=" col btn btn-danger">Limpiar</button>
                            </div>
                    </form>
                    </fieldset>

                <?php endif ?>
            </section>
        </div>
    </main>
</body>
</html>